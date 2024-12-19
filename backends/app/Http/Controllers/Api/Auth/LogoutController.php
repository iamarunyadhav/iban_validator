<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json([ 'message' => 'Logged out' ]);
        } catch (\Exception $e) {
            return response()->json([ 'message' => 'Failed to log user out' ], 500); // Internal Server Error
        }
    }
}
