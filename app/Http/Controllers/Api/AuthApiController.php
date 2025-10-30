<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthApiController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $data = $request->only('name','email','password','password_confirmation');

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed', // password_confirmation
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $user = User::create([
            'name' => $data['name'],
            'email'=> $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // If you want to auto-login after register, create token:
        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token'=> $token,
        ], 201);
    }

    // Login
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Optionally: revoke previous tokens for this device
        // $user->tokens()->delete();

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token'=> $token,
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        // delete current token
        $request->user()->currentAccessToken()->delete();

        // or delete all tokens: $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }

    // Get authenticated user
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    // Forgot password (send reset link)
    public function forgotPassword(Request $request)
    {
        $request->validate(['email'=>'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message'=>'Password reset link sent.']);
        } else {
            return response()->json(['message'=>'Unable to send reset link.'], 500);
        }
    }

    // Reset password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required', // token from email link
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password reset successfully.']);
        }

        return response()->json(['message' => 'Failed to reset password.'], 500);
    }

    // Email verify (optional) - if using signed URL mail
    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['message'=>'Invalid verification link.'], 403);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message'=>'Already verified.']);
        }

        $user->markEmailAsVerified();

        return response()->json(['message'=>'Email verified.']);
    }
}
