<?php

namespace App\Http\Controllers\api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;

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
        $transactions = TransactionResource::collection(Transaction::with(['book', 'publisher'])->get());
    
        return response()->json([
            'success'   => $transactions->isNotEmpty(),
            'message'   => $transactions->isNotEmpty() ? 'Successfully fetched transactions.' : 'Transaction not found.',
            'data'      => $transactions
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
        try {
            $transaction = Transaction::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Successfully created transaction.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success'   => false,
                'message'   => 'Failed to create transaction.',
                'error'     => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Remove the specified transaction from storage.
     *
     * Looks up a transaction by the given ID and deletes it.
     * Returns a JSON response indicating success or failure.
     * 
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
    
        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found.',
            ], 404);
        }
    
        $transaction->delete();
        return response()->json([
            'success' => true,
            'message' => 'Successfully deleted transaction.',
        ], 200);
    }
}
