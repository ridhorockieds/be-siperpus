<?php

namespace App\Http\Controllers\api;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublisherController extends Controller
{
    /**
     * Get all publishers.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $publishers = Publisher::all();
        
        if ($publishers->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No publisher found.'
            ], 200);
        }
        
        return response()->json([
            'success' => true,
            'data' => $publishers
        ], 200);
    }

    /**
     * Create a new publisher in storage.
     *
     * Validates the incoming request data and creates a new publisher record.
     * Returns a JSON response indicating success or failure.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        try {
            $publisher = Publisher::create($validated);
            
            return response()->json([
                'success' => true,
                'data' => $publisher,
                'message' => 'Publisher created successfully.'
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
     * Remove the specified publisher from storage.
     *
     * @param \App\Models\Publisher $publisher
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Publisher $publisher) {
        try {
            $publisher->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Publisher deleted successfully.'
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
