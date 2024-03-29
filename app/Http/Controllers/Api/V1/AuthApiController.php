<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\UserHelpers;
use App\Helpers\VerificationHelpers;
use App\Http\Controllers\BaseApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\ChangePasswordRequest;
use App\Http\Requests\Api\User\EmailVerificationRequest;
use App\Http\Requests\Api\User\ForgotPasswordRequest;
use App\Http\Requests\Api\User\LoginRequest;
use App\Http\Requests\Api\User\ResetPasswordRequest;
use App\Http\Requests\Api\User\SignUpRequest;
use App\Http\Requests\Api\User\VerifyForgotOTPRequest;
use App\Http\Requests\Api\User\VerifyPhoneRequest;
use App\Mail\UserVerification;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthApiController extends BaseApiController
{
    public function signUp(SignUpRequest $request)
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();

            $createdUser = UserHelpers::createUser([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => bcrypt($validated['password']),
            ]);

            $createdUser->save();

            $tokenResult = UserHelpers::createAndSaveAccessToken($createdUser);

            if (!$tokenResult) {
                return $this->sendError("Server Error. Please try again later.");
            }

            $token = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
            ];

            DB::commit();

            return $this->sendResponse(['token' => $token], "Your account has been created");
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return $this->sendError("Server Error. Please try again later.");
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $validate = $request->validated();

            $user = User::where('email', $validate['email'])->first();

            if (!$user) {
                return $this->sendError('The email is not found');
            }

            if (!Hash::check($request->password, $user->password)) {
                return $this->sendError('The email or password is incorrect.');
            }

            $tokenResult = UserHelpers::createAndSaveAccessToken($user);

            if (!$tokenResult) {
                return $this->sendError("Server Error. Please try again later.");
            }

            $token = [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
            ];

            $message = 'Login successful';

            return $this->sendResponse(['token' => $token], $message);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();
            return $this->sendResponse([], 'Logout Successful.');
        } catch (Exception $e) {
            return $this->sendError("Server Error. Please try again later.");
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'old_password' => 'required|string|min:8|max:20',
                'new_password' => 'required|string|min:8|max:20',
            ]);

            $user = User::findOrfail(auth('api')->user()->id);

            if (!(Hash::check($request['old_password'], $user->getAuthPassword()))) {
                return $this->sendError('Your old password does not match with the password you provided. Please try again.');
            }

            if (strcmp($request['old_password'], $request['new_password']) == 0) {
                return $this->sendError('New Password cannot be same as your old password. Please choose a different password.');
            }

            $user->password = bcrypt($request['new_password']);
            $user->save();

            return $this->sendResponse([
                'user' => $user,
            ], "Password updated successfully");
        } catch (Exception $e) {
            dd($e->getMessage());
            return $this->sendError("Server Error. Please try again later.");
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return $this->sendError('User not found with this email.');
            }

            if ($user->otp_sent_at) {
                $diffInSeconds = (int) Carbon::now()->diffInSeconds($user->otp_sent_at);
            }

            if ($user->otp && $diffInSeconds < 180) {
                return $this->sendError("Verification sent already! Please try again in " . 180 - $diffInSeconds . " seconds.");
            }

            $email_verifiaction_code = VerificationHelpers::generateVerificationCode();

            $user->otp = $email_verifiaction_code;
            $user->otp_sent_at = Carbon::now();

            $temp_token = $this->generateTemporaryToken();

            if (!$temp_token) {
                return $this->errorResponse('Sorry! We cannot process your request at this moment. Please contact customer support for more details.');
            }
            $user->temp_token = $temp_token;
            $user->save();

            Mail::to($user->email)->send(new \App\Mail\SendOTP($user));

            return $this->sendResponse([
                'temp_token' => $temp_token,
            ], "OTP has been sent to your email");
        } catch (Exception $e) {
            dd($e->getMessage());
            return $this->sendError("Server Error. Please try again later.");
        }
    }

    protected function generateTemporaryToken()
    {
        $temp_token = Str::random(60);

        if (User::where('temp_token', $temp_token)->count() == 0) {
            return $temp_token;
        }

        $this->generateTemporaryToken();
    }

    public function forgotOTPVerify(Request $request)
    {
        try {

            $user = User::where('temp_token', $request->temp_token)
                ->where('otp', $request->otp)
                ->first();

            if (!$user) {
                return $this->sendError('The email / otp does not match');
            }

            if (((int) Carbon::now()->diffInSeconds($user->otp_sent_at)) > 600) {
                return $this->sendError("OTP Expired");
            }

            $user->otp_verified_at = Carbon::now();
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'OTP verified !!',
            ]);
        } catch (Exception $e) {
            return $this->sendError("Server Error. Please try again later.");
        }
    }

    public function resetPassword(Request $request)
    {
        try {

            $user = User::where('temp_token', $request->temp_token)->where('otp', $request->otp)->first();

            if (!$user) {
                return $this->sendError('The email / otp does not match');
            }

            $user->password = bcrypt($request->new_password);
            $user->otp = null;
            $user->temp_token = null;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Password Reset Successfully',
            ]);
        } catch (Exception $e) {
            return $this->sendError("Server Error. Please try again later.");
        }
    }
}
