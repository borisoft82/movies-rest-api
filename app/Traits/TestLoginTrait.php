<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Constants\GlobalConstants;

trait TestLoginTrait {

    public function test_user_logged_in(): array
    {
        $user = Factory::factoryForModel('User')->create();     
        $data = ['email' => $user->email, 'password' => 'password'];
        $response = $this->json('POST', GlobalConstants::API . '/login', $data);        
        $response->assertStatus(200);
        
        return [
            'user' => $user, 
            'token' => $response['authorization']['token']
        ];
    }
}
