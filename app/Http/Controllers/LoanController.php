<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        $loan = Loan::create([
            'user_id' => auth()->user()->id,  // Assuming you're associating the loan with the authenticated user
            'amount' => $request->amount,
            'interest_rate' => $request->interest_rate,
            'duration' => $request->duration,
        ]);

        return response()->json($loan, 201);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $loans = auth()->user()->loans;  // Get all loans for the authenticated user
        return response()->json($loans);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $loan = auth()->user()->loans()->find($id);

        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }

        return response()->json($loan);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $loan = auth()->user()->loans()->find($id);

        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        $loan->update([
            'amount' => $request->amount,
            'interest_rate' => $request->interest_rate,
            'duration' => $request->duration,
        ]);

        return response()->json($loan);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $loan = auth()->user()->loans()->find($id);

        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }

        $loan->delete();
        return response()->json(['message' => 'Loan deleted successfully']);
    }
}
