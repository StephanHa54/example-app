<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Http\Helpers\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Update the authorized user
     * @param Request $request 
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateUser (Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255']
        ]);

        $request->user()->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
        ]);

        return response()->json( 'user updated', 200 );
    }

    /**
     * Update the password for the authorized user
     * @param Request $request 
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json( 'password updated', 200 );
    }

    /**
     * Upload an avatar image for the authorized user
     * @param Request $request The request data from the user.
     * @return \Illuminate\Http\Response
     */
    public function uploadAvatar(Request $request): string
    {
        $request->validate([
            'file' => ['required', 'file', 'image', 'mimes:jpeg,jpg,png,gif','max:10000']
        ]);

        $user = User::find(Auth::id());

        if($user->avatar !== 'avatar.png'){
            Storage::disk('files')->delete('/avatars/'.$user->id.'/'.$user->avatar);
        }

        $upload = new Upload();
        $avatar = $upload->upload($request->file, 'avatars/'.Auth::id())->resize(200, 200)->getData();
        $user->avatar = $avatar['basename'];
        $user->save();
        return $user;
    }

    /**
     * Remove the user uploaded avatar image and go back to default avatar image
     * @param Request $request The request data from the user.
     * @return \Illuminate\Http\Response
     */
    public function removeAvatar()
    {
        $user = User::find(Auth::id());

        if($user->avatar === 'avatar.png'){
            return $user;
        }else{
            Storage::disk('files')->delete('/avatars/'.$user->id.'/'.$user->avatar);
            $user->avatar = 'avatar.png';
            $user->save();
            return $user;
        }
    }
    
    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }

    /**
     * web route
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
}
