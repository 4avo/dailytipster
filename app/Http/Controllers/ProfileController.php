<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\SportmonksApiController;

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

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
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

        return redirect()->to('/');
    }
    
    /**
     * Display the welcome page with necessary data.
     */
    public function index(SportmonksApiController $sportmonksApiController): View
    {
        // Fetch leagues data from Sportmonks API
        $leaguesResponse = $sportmonksApiController->leagues();
        $leagues = $leaguesResponse->original; // Assuming response is JSON decoded already

        // Fetch users data (assuming it's required)
        $users = User::all();

        return view('welcome', compact('leagues', 'users'));
    }
}
