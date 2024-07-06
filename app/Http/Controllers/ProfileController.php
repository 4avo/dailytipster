<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Prediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        // Fetch the authenticated user
        $user = auth()->user();

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            return Redirect::route('profile.edit')->with('status', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return Redirect::route('profile.edit')->with('status', 'Failed to update profile.');
        }
    }

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
    $leaguesData = [];

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
