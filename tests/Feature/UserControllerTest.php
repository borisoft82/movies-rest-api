<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Constants\GlobalConstants;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_registered(): void
    {        
        $data = [         
            'name' => 'Test',   
            'email' => 'test' . random_int(1, 100) . '@test.ba',
            'password' => 'password'
        ];

        $response = $this->json('POST', GlobalConstants::API . '/register', $data);
        $response->assertStatus(200);
    }
}
