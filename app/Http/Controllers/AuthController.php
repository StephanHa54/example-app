<?php

namespace App\Http\Controllers;

use Avatar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    /**
     * Create user & create access token
     * @param  [string] firstname
     * @param  [string] lastname
     * @param  [string] email
     * @param  [string] password
     */
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Get the intials of the new user to create default avatar image
        $initials = $user->first_name[0] . ' ' . $user->last_name[0];
        $avatar = Avatar::create($initials)->getImageObject()->encode('png');
        Storage::disk('files')->put('avatars/'.$user->id.'/avatar.png', (string) $avatar, 'public');

        event(new Registered($user));

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    /**
     * Login user and create token
     * @param  [string] email
     * @param  [string] password
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    /**
     * Logout user (Revoke the token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
