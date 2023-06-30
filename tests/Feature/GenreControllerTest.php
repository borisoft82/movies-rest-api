<?php

namespace Tests\Feature;

use App\Traits\TestLoginTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Constants\GlobalConstants;

class GenreControllerTest extends TestCase
{
    use RefreshDatabase, TestLoginTrait;

    public function test_create_genre(): void
    {        
        $user = $this->test_user_logged_in();
        
        $data = [         
            'name' => 'Genre' . random_int(1, 100),   
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('POST', GlobalConstants::API . '/' . GlobalConstants::PREFIX_GENRES . '/create', $data);

        $response->assertStatus(200);
    }

    public function test_get_all_genres(): void
    {             
        $user = $this->test_user_logged_in();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', GlobalConstants::API . '/' . GlobalConstants::PREFIX_GENRES);

        $response->assertStatus(200);
    }

    public function test_get_one_genre(): void
    {
        $user = $this->test_user_logged_in();

        $genre = Factory::factoryForModel('Genre')->create();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('GET', GlobalConstants::API . '/'  . GlobalConstants::PREFIX_GENRES . '/' . $genre->id);

        $response->assertStatus(200);
    }

    public function test_update_specific_genre(): void
    {
        $user = $this->test_user_logged_in();

        $genre = Factory::factoryForModel('Genre')->create();
        
        $data = [         
            'name' => 'Genre' . random_int(1, 100),   
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('PUT', GlobalConstants::API . '/'  . GlobalConstants::PREFIX_GENRES .  '/update' . '/' . $genre->id, $data);

        $response->assertStatus(200);
    }

    public function test_delete_specific_genre(): void
    {
        $user = $this->test_user_logged_in(); 

        $genre = Factory::factoryForModel('Genre')->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $user['token'],
        ])->json('DELETE', GlobalConstants::API . '/' . GlobalConstants::PREFIX_GENRES . '/delete' . '/' . $genre->id);

        $response->assertStatus(204);
    }

}
