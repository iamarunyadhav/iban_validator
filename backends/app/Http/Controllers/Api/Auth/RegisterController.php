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
            // Validation rules
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);
    
            // Check if validation fails
            if ($validator->fails()) {
                $errors = $validator->errors();
                $customErrors = [];
    
                // Customizing error messages
                foreach ($errors->getMessages() as $field => $message) {
                    if ($field === 'email' && in_array('The email has already been taken.', $message)) {
                        $customErrors[$field] = ['This email address is already registered with us. Please use another email.'];
                    } else {
                        $customErrors[$field] = $message;
                    }
                }
    
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error or Duplicated email',
                    'errors' => $customErrors
                ], 401);  // Using 401 Unauthorized might not be appropriate for validation errors. Consider using 422 Unprocessable Entity.
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
            // It's a good idea to log this error.
            Log::error('Error creating user: ' . $th->getMessage());
    
            return response()->json([
                'status' => false,
                'message' => 'Failed to create user due to a server error.'
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    // public function loginUser(Request $request)
    // {
    //     try {
    //         $validateUser = Validator::make($request->all(),
    //         [
    //             'email' => 'required|email',
    //             'password' => 'required'
    //         ]);

    //         if($validateUser->fails()){
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'validation error',
    //                 'errors' => $validateUser->errors()
    //             ], 401);
    //         }

    //         if(!Auth::attempt($request->only(['email', 'password']))){
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Email & Password does not match with our record.',
    //             ], 401);
    //         }

    //         $user = User::where('email', $request->email)->first();
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'User Logged In Successfully',
    //             'token' => $user->createToken("API TOKEN")->plainTextToken,
    //             'user_id' => $user->id,
    //             'user_role' => $user->role
    //         ], 200);

    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $th->getMessage()
    //         ], 500);
    //     }
    // }
}
