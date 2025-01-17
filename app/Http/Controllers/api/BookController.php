<?php

namespace App\Http\Controllers\api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    /**
     * Display a listing of all books.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $books = BookResource::collection(Book::all());
        
        return response()->json([
            'success' => $books->isNotEmpty(),
            'message' => $books->isNotEmpty() ? 'Successfully fetched book.' : 'Book not found.',
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
    public function store(Request $request)
    {
        try {
            $book = Book::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Successfully created book.',
                'data' => $book
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create book.',
                'error' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Remove the specified book from storage.
     *
     * @param \App\Models\Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found.',
            ], 404);
        }

        $book->delete();
        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted book.',
        ], 200);
    }
}
