<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    const UNAUTHORIZED_ACTION_MESSAGE = 'User unauthorized to perform this action.';
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
            'borrower_user_id' => 'required|numeric|exists:users,id'
        ]);
        $user = auth()->user();
        if ($user->tokenCan('abilities:loan-create,loan-update,loan-delete')) {
            $loan = Loan::create([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'interest_rate' => $request->interest_rate,
                'duration' => $request->duration,
                'borrower_user_id' => $request->borrower_user_id
            ]);
            return response()->json($loan, 201);
        } else {
            return response()->json(['message' => self::UNAUTHORIZED_ACTION_MESSAGE], 400);
        }

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
        $user = auth()->user();
        $loan = $user->loans()->find($id);

        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'interest_rate' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);
        if ($user->tokenCan('abilities:loan-create,loan-update,loan-delete')) {
            $loan->update([
                'amount' => $request->amount,
                'interest_rate' => $request->interest_rate,
                'duration' => $request->duration,
            ]);
            return response()->json($loan);
        } else {
            return response()->json(['message' => self::UNAUTHORIZED_ACTION_MESSAGE], 400);
        }


    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $loan = $user->loans()->find($id);

        if (!$loan) {
            return response()->json(['message' => 'Loan not found'], 404);
        }
        if ($user->tokenCan(self::UNAUTHORIZED_ACTION_MESSAGE)) {
            $loan->delete();
            return response()->json(['message' => 'Loan deleted successfully']);
        } else {
            return response()->json(['message' => self::UNAUTHORIZED_ACTION_MESSAGE], 400);
        }

    }
}
