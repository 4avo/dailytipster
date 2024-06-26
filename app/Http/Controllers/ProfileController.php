<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

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
    // Fetch users from the database sorted by credits
    $users = User::orderBy('credits', 'desc')->get();

    // Load leagues data from the new JSON file
    $leaguesData = json_decode(file_get_contents(storage_path('app/leagues.json')), true);

    // Load teams data from the top_20_leagues_teams.json file
    $teamsData = json_decode(file_get_contents(storage_path('app/top_20_leagues_teams.json')), true);

    // Parse leagues data
    $leagues = array_map(function ($leagueData) {
        return [
            'id' => $leagueData['league']['id'],
            'name' => $leagueData['league']['name'],
            'logo' => $leagueData['league']['logo'],
            'country_code' => $leagueData['country']['code'],
            'country_flag' => $leagueData['country']['flag'],
            'country_name' => $leagueData['country']['name'],
        ];
    }, $leaguesData);

    // Pass users, leagues, and teams data to the view
    return view('welcome', compact('users', 'leagues', 'teamsData'));
}

    public function leaderboard()
    {
        // Fetch users from the database sorted by credits
        $users = User::orderBy('credits', 'desc')->get();

        // Pass users data to the view
        return view('leaderboard', compact('users'));
    }

}
