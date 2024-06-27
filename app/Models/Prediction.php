<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'league_id',
        'home_team',
        'away_team',
        'prediction',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
