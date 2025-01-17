<?php

namespace App\Http\Controllers\api;

use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PublisherResource;

class PublisherController extends Controller
{
    /**
     * Get all publishers.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $publishers = PublisherResource::collection(Publisher::all());
        
        return response()->json([
            'success'   => $publishers->isNotEmpty(),
            'message'   => $publishers->isNotEmpty() ? 'Successfully fetched publishers.' : 'Publishers not found.',
            'data'      => $publishers
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
        try {
            $publisher = Publisher::create($request->all());

            return response()->json([
                'success'   => true,
                'message'   => 'Successfully created publisher.',
                'data'      => $publisher
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Failed to create publisher.',
                'error'     => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Remove the specified publisher from storage.
     *
     * @param \App\Models\Publisher $publisher
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $publisher = Publisher::find($id);

        if (!$publisher) {
            return response()->json([
                'success' => false,
                'message' => 'Publisher not found.',
            ], 404);
        }

        $publisher->delete();
        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted publisher.',
        ], 200);
    }
}
