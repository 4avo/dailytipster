<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsSeeder extends Seeder
{
    public function run()
    {
        DB::table('items')->insert([
            [
                'name' => 'VIP Badge',
                'description' => 'Item 1 description',
                'price' => 10,
                'image' => 'public\images\vip.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ULTRA Badge',
                'description' => 'Item 2 description',
                'price' => 20,
                'image' => 'public\images\vip.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
