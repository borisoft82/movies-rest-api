<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movie_users')->insert(
            [
                [
                    'user_id' => 11,
                    'movie_id' => 1,
                ],
                [
                    'user_id' => 11,
                    'movie_id' => 2,
                ],
                [
                    'user_id' => 11,
                    'movie_id' => 3,
                ],
                [
                    'user_id' => 5,
                    'movie_id' => 2,
                ],
                [
                    'user_id' => 5,
                    'movie_id' => 3,
                ],
                [
                    'user_id' => 8,
                    'movie_id' => 4,
                ],
                [
                    'user_id' => 8,
                    'movie_id' => 5,
                ],
                [
                    'user_id' => 8,
                    'movie_id' => 6,
                ]
            ]);
    }
}
