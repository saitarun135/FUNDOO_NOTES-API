<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class RegistrationTest extends TestCase
{
    
    /* 
    *create user if valid credentials entered
    */
    public function test_validCredentials(){
        $response = $this->json('POST','/api/register',[
            "name"=>"saiTarun",
            "email"=>"sai12345@gmail.com",
            "password"=>"SAItarun*1",
            "password_confirmation"=>"SAItarun*1"
            ]);
            $response->assertStatus(201);
    }
}
