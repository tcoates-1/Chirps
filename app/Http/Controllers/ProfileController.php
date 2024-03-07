<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

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

        $request->validate([
            'profile_image' => 'url|active_url',
            'username' => ['required', 'string', 'max:255', 'unique:users,username,'],
        ]);
    
        auth()->user()->update([
            'profile_image' => $request->input('profile_image'),
            'username' => $request->username,
        ]);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

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

    public function index()
    {
        $users = User::withCount('chirps')->get();
        return view('profile.index', compact('users'));
    }

    public function show($username)
    {
        // Fetch user data from the database based on the username
        $user = User::withCount('chirps')->where('username', $username)->first();

        if (!$user) {
            abort(404); // User not found
        }

        // Fetch chirps for the user
        $chirps = $user->chirps;

        return view('profile.profile', compact('user', 'chirps',));
    }
}


