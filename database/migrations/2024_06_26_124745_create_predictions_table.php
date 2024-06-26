<?php

// database/migrations/create_predictions_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('home_team');
            $table->string('away_team');
            $table->string('prediction');
            $table->string('status')->default('Pending'); // Set default status
            $table->timestamps(); // Includes created_at and updated_at columns
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
