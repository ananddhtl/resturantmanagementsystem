<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Jobs\SendPasswordResetTokenMailJob;
use App\Models\PasswordResetToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 422);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $user = new UserResource(Auth::user());


            return response()->json([
                    'status' => true,
                    'data' => [
                        'user' => $user,
                        'token' => [
                            'access_token' => $user->createToken('ApiToken')->plainTextToken,
                            'token_type' => 'bearer'
                        ]
                    ]
                ]
            );
        } else {
            return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
        }
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:50|confirmed',
            'phone' => 'required|string|max:20'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);
        $user = new UserResource($user);


        return response()->json([
            'status' => true, 'message' => 'User created successfully',
            'data' => [
                'user' => $user,
                'token' => [
                    'access_token' => $user->createToken('ApiToken')->plainTextToken,
                    'token_type' => 'bearer'
                ]
            ]
        ], 201);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'status' => true, 'message' => 'Successfully logged out',
        ]);
    }

    public function user(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => new UserResource(\auth()->user())
        ]);
    }

    public function verifyOTP(Request $request)
    {
        try {
            $user = auth()->user();

            if ($user->otp == $request->get('otp')) {
                $user->otp_verified_at = Carbon::now();
                $user->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Successfully verified!'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid code! Failed to verify'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function sendPasswordResetToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        do {
            $token = strtolower(str()->random(6));
        } while (PasswordResetToken::query()->where('token', '=', $token)->exists());

        $data = [
            'email' => $request->email,
            'token' => $token
        ];

        $old_token = PasswordResetToken::query()->where('email', '=', $request->email)->first();

        dispatch(new SendPasswordResetTokenMailJob($data));

        if ($old_token) {
            $old_token->update(['token' => $token]);
        } else {
            PasswordResetToken::query()->create($data);
        }

        return response()->json(['status' => true, 'message' => 'Send Successfully!'], 200);
    }

    public function verifyPasswordResetToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string|exists:password_reset_tokens,token'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $token = PasswordResetToken::query()->where('token', '=', $request->token)->first();

        $user = $token->user;

        return response()->json(['status' => true, 'message' => 'Validated successfully', 'user' => $user], 200);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:8|max:30',
            'new_password' => 'required|min:8|max:30',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        try {
            $user = auth()->user();

            if (!(Hash::check($request->get('old_password'), $user->getAuthPassword()))) {
                return response()->json(['status' => false, 'message' => 'Your current password does not match with the password you provided. Please try again.']);
            }

            $user->password = Hash::make($request->new_password);
            $user->update();

            return response()->json([
                'status' => true,
                'data' => $user,
                'message' => 'Password updated successfully.'
            ], 200);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'message' => $ex->getMessage()]);
        }
    }

    public function forgotPassword(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validate->fails()) {
            return response()->json(['status' => false, 'message' => $validate->errors()->first()], 422);
        }

        try {
            $user = User::where('email', $validate->validated()['email'])->first();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'The email is not found',
                ], 401);
            } else {
                $userId = $user->id;
                $verificationCode = 12345;
                $user->otp = $verificationCode;
                $user->save();

                //TODO: send verification code to iser
                return response()->json([
                    'status' => true,
                    'user_id' => $userId
                ], 200);

            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 401);
        }


    }

    public function resetPassword(Request $request)
    {
        try {
            $validate = $request->validate([
                'otp' => 'required',
                'user_id' => 'required',
                'new_password' => 'required',
            ]);
            $user = User::where('id', $validate['user_id'])->where('otp', $validate['otp'])->first();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid OTP',
                ], 401);
            } else {
                $updateCustomer = $user;
                $updateCustomer->password = bcrypt($request->new_password);
                $updateCustomer->update();

                return response()->json([
                    'status' => true,
                    'message' => 'Password Reset Successfully.'
                ], 201);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

}
