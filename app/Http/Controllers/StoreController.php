<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item; // Import the Item model

class StoreController extends Controller
{
    public function index()
    {
        $items = Item::all(); // Fetch all items from the database

        return view('store', [
            'items' => $items, // Pass the items data to the view
        ]);
    }
}
