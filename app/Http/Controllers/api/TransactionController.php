<?php

namespace App\Http\Controllers\api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{

    /**
     * Fetch all transactions.
     *
     * Returns a JSON response with success boolean, descriptive message, and
     * an array of all transactions if found. If no transactions are found,
     * returns an empty array.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $transactions = Transaction::all();

        if($transactions) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully fetched transactions.',
                'data' => $transactions
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Transaction not found.',
            'data' => []
        ], 200);
    }

    /**
     * Create a new transaction in storage.
     *
     * Validates the incoming request data and creates a new transaction record.
     * Returns a JSON response indicating success or failure.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $transaction = Transaction::create($request->all());

        if($transaction) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully created transaction.',
                'data' => $transaction
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to create transaction.',
        ], 200);
    }
}
