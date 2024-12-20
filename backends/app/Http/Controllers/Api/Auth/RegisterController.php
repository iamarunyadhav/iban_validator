<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request)
        {
            try {
                // Enhanced password validation rules
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => [
                        'required',
                        'min:8', // minimum 8 characters
                        'regex:/[a-z]/',      // must contain at least one lowercase letter
                        'regex:/[A-Z]/',      // must contain at least one uppercase letter
                        'regex:/[0-9]/',      // must contain at least one digit
                        'regex:/[@$!%*#?&]/', // must contain a special character
                    ]
                ]);

                // Check if validation fails
                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Validation errors',
                        'errors' => $validator->errors()
                    ], 422); // Using 422 Unprocessable Entity for validation errors
                }

                // Creating the user
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'User Created Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 201);

            } catch (\Throwable $th) {
                Log::error('Error creating user: ' . $th->getMessage());

                return response()->json([
                    'status' => false,
                    'message' => 'Failed to create user due to server error'
                ], 500);
            }
        }

    }
            