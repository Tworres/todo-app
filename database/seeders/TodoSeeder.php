<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('todos')->insert([
            'name' => Str::random(10),
            'completed' => true,
        ]);
        DB::table('todos')->insert([
            'name' => Str::random(10),
            'completed' => false,
        ]);
        DB::table('todos')->insert([
            'name' => Str::random(80),
            'completed' => true,
        ]);
        DB::table('todos')->insert([
            'name' => Str::random(80),
            'completed' => false,
        ]);
    }
}