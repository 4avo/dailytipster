<?php

// app/Http/Controllers/ProfileController.php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prediction;
use Illuminate\Http\Request;
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

    /**
     * Display the leaderboard.
     */
    public function leaderboard()
    {
        // Fetch users from the database sorted by credits
        $users = User::orderBy('credits', 'desc')->get();

        // Pass users data to the view
        return view('leaderboard', compact('users'));
    }

    /**
     * Display the home page with users, leagues, and teams data.
     */
    public function index()
{
    // Fetch users from the database sorted by credits
    $users = User::orderBy('credits', 'desc')->get();

    // Load the combined leagues and teams data from the JSON file
    $leaguesData = json_decode(file_get_contents(storage_path('app/leagues.json')), true);

    // Parse leagues data
    $leagues = array_map(function ($leagueData) {
        return [
            'id' => $leagueData['league']['id'],
            'name' => $leagueData['league']['name'],
            'logo' => $leagueData['league']['logo'],
            'teams' => $leagueData['teams']
        ];
    }, $leaguesData);

    // Fetch the current user's predictions
    $predictions = Prediction::where('user_id', Auth::id())->get();

    // Fetch random predictions from other users and ensure the user relationship is loaded
    $randomPredictions = Prediction::with('user')->inRandomOrder()->take(5)->get();

    // Pass users, leagues, and predictions data to the view
    return view('welcome', compact('users', 'leagues', 'predictions', 'randomPredictions'));
}



    /**
     * Store a new prediction.
     */
    public function storePrediction(Request $request)
{
    $request->validate([
        'home_team' => 'required',
        'away_team' => 'required',
        'prediction' => 'required',
        'description' => 'required',
        'probability' => 'required|integer|min:0|max:100',
    ]);

    // Store the prediction
    $prediction = new Prediction();
    $prediction->home_team = $request->home_team;
    $prediction->away_team = $request->away_team;
    $prediction->prediction = $request->prediction;
    $prediction->description = $request->description;
    $prediction->probability = $request->probability;
    $prediction->user_id = auth()->id();
    $prediction->save();

    return redirect()->back()->with('success', 'Prediction submitted successfully!');
}
}
