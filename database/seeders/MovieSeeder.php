<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::factory(30)->create();

        DB::table('movies')->insert(
            [
                [
                    'title' => "Big movie",
                    'storyline' => "Big movie storyline",
                    'director' => "Pjer Zalica",
                    'slug' => "big-movie",
                    'writer' => "Writer",
                    'cast' => "Cast",
                    'user_id' => 1,
                    'genre_id' => 1,
                    'created_at' => '2023-05-17 12:24:45',
                    'updated_at' => '2023-05-17 12:24:45'
                ],
            ]
        );
    }
}
