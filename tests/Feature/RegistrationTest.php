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
            "email"=>"sai145@gmail.com",
            "password"=>"SAItarun*1",
            "password_confirmation"=>"SAItarun*1"
            ]);
            $response->assertStatus(201);
    }

    /**
     * invalid credentials 
    */

    public function test_InvalidCredentials(){
        $response = $this->json('POST','/api/register',[
            "name"=>"saiTarun",
            "email"=>"sai15@gmail.com",
            "password"=>"SAItarun*1",
            "password_confirmation"=>"SAIta1"
            ]);
            $response->assertStatus(422);
    }

}
