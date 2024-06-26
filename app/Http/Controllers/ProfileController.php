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
use App\Notifications\NewFollower;

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
        $user = $request->user();
    
        $rules = [];

        if ($request->hasFile('profile_image')) {
            $rules['profile_image'] = 'nullable|image|max:2048';

            $imagePath = $request->file('profile_image')->store('profile_pictures', 'public');
            $user->profile_image = Storage::url($imagePath);
        }
        
        if ($request->has('username') && $request->username !== $user->username) {
            $rules['username'] = ['string', 'max:255', 'unique:users,username'];
            $user->username = $request->username;
        }

        $request->validate($rules);
    
        $user->fill($request->except('profile_image', 'username'));
    
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        $user->save();
    
        return back()->with(['message' => 'Profile Successfully Updated!', 'status', 'profile-updated']);
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
            abort(404); 
        }

        // Fetch chirps for the user
        $chirps = $user->chirps()->latest()->get();

        return view('profile.profile', compact('user', 'chirps'));
    }

    public function follow(Request $request) 
    {
        $user_id = $request->userToFollow;
        $user = $request->user();

        if($user->id == $user_id){
            return back()->with(['message' => 'You cannot follow yourself!', 'user_id' => $user->id]);
        }
        
        if($user->follows()->where('user_id', $user_id)->exists()){
            return back()->with(['message' => 'You are already following this user!', 'user_id' => $user_id]);
        }
        
        $user->follows()->attach($user_id);
        
        // notify followed user that they have a new follower
        $followedUser = User::find($user_id);
        $followedUser->notify(new NewFollower($user));
        
        return back()->with(['message' => 'You are now following!', 'user_id' => $user_id]);
    }

    public function unfollow(Request $request)
    {
        $user_id = $request->userToUnfollow;
        $user = $request->user();

        if ($user->follows()->where('user_id', $user_id)->exists()){
            $user->follows()->detach($user_id);
            return back()->with(['message' => 'You have successfully unfollowed!', 'user_id' => $user_id]);
        }
        else {
            return back()->with(['message' => 'You are not following this user!', 'user_id' => $user_id]);
        }
    }

    public function dashboard(Request $request)
    {
        $user = $request->user();
        $allChirps = collect();
        foreach($user->chirps as $chirps){
            $allChirps->push($chirps);
        }
        foreach($user->follows as $followedUser){
            foreach($followedUser->chirps as $chirp){
                $allChirps->push($chirp);
            }
        }
        $sortedChirps = $allChirps->sortByDesc('created_at');

        return view('dashboard', ['user' => $user, 'sortedChirps' => $sortedChirps]);
    }
}


