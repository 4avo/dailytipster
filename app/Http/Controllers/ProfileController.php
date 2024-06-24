<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
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
        // Fetch users from the database
        $users = User::all();

        // Create a Guzzle HTTP client instance
        $client = new Client();

        try {
            // Make a GET request to the API endpoint
            $response = $client->request('GET', 'https://api-football-v1.p.rapidapi.com/v3/leagues', [
                'headers' => [
                    'x-rapidapi-host' => 'api-football-v1.p.rapidapi.com',
                    'x-rapidapi-key' => 'fcf3c2a832msh24812e500083af3p14b6fejsn3c909a197fa8',
                ],
            ]);

            // Get the response body and decode it from JSON to an array
            $leagues = json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            // Handle any exceptions (e.g., API not reachable, authentication error)
            $leagues = [];
            // Log the error
            \Log::error('Error fetching leagues: ' . $e->getMessage());
        }

        // Pass users and leagues data to the view
        return view('welcome', compact('users', 'leagues'));
    }
}
