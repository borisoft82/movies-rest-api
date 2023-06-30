<?php

namespace Tests\Feature;

use App\Traits\TestLoginTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Constants\GlobalConstants;

class MovieControllerTest extends TestCase
{
    use RefreshDatabase, TestLoginTrait;

    public function test_user_create_movie(): void
    {        
        $user = $this->test_user_logged_in();

        Factory::factoryForModel('Genre')->create(['id' => 1]);
        
        $data = [         
            'title' => 'Test movie title' . random_int(1, 100),   
            'storyline' => 'Test movie storyline',
            'image' => '',
            'slug' => 'test-movie-title' . random_int(1, 100),
            'director' => 'Test director',
            'writer' => 'Test writer',
            'cast' => 'Test cast',
            'user_id' => $user['user']->id,
            'genre_id' => 1
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('POST', GlobalConstants::API . '/' . GlobalConstants::PREFIX_MOVIES . '/create', $data);

        $response->assertStatus(200);
    }

    public function test_get_all_movies(): void
    {             
        $user = $this->test_user_logged_in();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', GlobalConstants::API . '/movies');

        $response->assertStatus(200);
    }

    public function test_get_one_movie(): void
    {
        $user = $this->test_user_logged_in();

        Factory::factoryForModel('Genre')->create(['id' => 1]);

        $movie = Factory::factoryForModel('Movie')->create(['user_id' => $user['user']['id'], 'genre_id' => 1]);
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', GlobalConstants::API . '/' . GlobalConstants::PREFIX_MOVIES . '/' . $movie->id);

        $response->assertStatus(200);
    }

    public function test_update_specific_movie(): void
    {
        $user = $this->test_user_logged_in();

        Factory::factoryForModel('Genre')->create(['id' => 1]);

        $movie = Factory::factoryForModel('Movie')->create(['user_id' => $user['user']['id'], 'genre_id' => 1]);
        
        $data = [         
            'title' => 'Test movie updated' . random_int(1, 100),   
            'storyline' => 'Test movie updated',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('PUT', GlobalConstants::API . '/' . GlobalConstants::PREFIX_MOVIES . '/update' . '/' . $movie->id, $data);

        $response->assertStatus(200);
    }

    public function test_delete_specific_movie(): void
    {
        $user = $this->test_user_logged_in(); 

        Factory::factoryForModel('Genre')->create(['id' => 1]);

        $movie = Factory::factoryForModel('Movie')->create(['user_id' => $user['user']['id'], 'genre_id' => 1]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('DELETE', GlobalConstants::API . '/' . GlobalConstants::PREFIX_MOVIES . '/delete' . '/' . $movie->id);

        $response->assertStatus(204);
    }

}
