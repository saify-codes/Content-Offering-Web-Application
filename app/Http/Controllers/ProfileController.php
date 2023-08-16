<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\SocialMediaUpdateRequest;
use App\Models\SocialAccounts;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        
        $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }

        if($request->file('avatar')){
            $filename = basename($request->file('avatar')->store('profiles','public'));
            $request->user()->avatar = $filename;
            
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    
    /**
     * Update the user's social media information.
     */
    public function update_social_account(SocialMediaUpdateRequest $request): RedirectResponse
    {
        // dd($request->validated());

        $user = $request->user();

        if ($user->social_media_account) {
            $user->social_media_account->fill($request->validated());
            $user->social_media_account->save();
        } else {
            $newSocialMediaAccount = new SocialAccounts($request->validated());
            $user->social_media_account()->save($newSocialMediaAccount);
        }


        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
