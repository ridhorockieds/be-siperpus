<?php

namespace App\Http\Controllers\api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    /**
     * Display a listing of all books.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $books = Book::all();
        
        if ($books->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Books not found.',
                'data' => []
            ], 200);
        }
        
        return response()->json([
            'success' => true,
            'data' => $books
        ], 200);
    }

    /**
     * Store a newly created book in storage.
     *
     * Validates the incoming request data and creates a new book record.
     * Returns a JSON response indicating success or failure.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required',
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric']
        ]);

        try {
            $book = Book::create($validated);

            return response()->json([
                'success' => true,
                'data' => $book,
                'message' => 'Book created successfully.'
            ], 200);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified book from storage.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book) {
        try {
            $book->delete();

            return response()->json([
                'success' => true,
                'message' => 'Book deleted successfully.'
            ], 200);
        } catch (\Throwable $th) {
            info($th);

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
