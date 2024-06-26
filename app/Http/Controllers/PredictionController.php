<?php
// database/migrations/create_predictions_table.php
// app/Http/Controllers/PredictionController.php
namespace App\Http\Controllers;

use App\Models\Prediction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PredictionController extends Controller
{
    /**
     * Display the user's predictions.
     */
    public function index()
    {
        // Fetch the current user's predictions
        $predictions = Prediction::where('user_id', Auth::id())->get();

        // Pass predictions data to the view
        return view('predictions', compact('predictions'));
    }

    /**
     * Store a new prediction.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'home_team' => 'required|string',
            'away_team' => 'required|string|different:home_team',
            'prediction' => 'required|string',
        ]);

        // Create a new prediction
        $prediction = new Prediction();
        $prediction->user_id = Auth::id();
        $prediction->home_team = $request->home_team;
        $prediction->away_team = $request->away_team;
        $prediction->prediction = $request->prediction;
        $prediction->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Prediction saved successfully. Please wait while we approve your prediction.');
    }
}


