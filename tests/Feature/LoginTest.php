<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class LoginTest extends TestCase
{
    private $user;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    
    /*
    *Guest user tries to login gives unprocessible entry
    */

    public function test_Login_Guest()
    {
        $response = $this->json('POST','/api/login',[
        ]);
        $response->assertStatus(422);
    }

    /* 
    * valid user login it should return true
    */

    public function test_Login_ValidUser()
    {
        $response = $this->json('POST','/api/login',[
            "email"=>"nikhil@gmail.com",
            "password"=>"SAItarun*1"
        ]);
        $response->assertStatus(200);
    }
   
   
 /* 
    * invalid credentials 
    */
    public function test_Login_Invalid_Credentials()
    {
        $response = $this->json('POST','/api/login',[
            "email"=>"nikhil@gmail.com",
            "password"=>"SAItarun1"
        ]);
        $response->assertStatus(401);
    }

 

}
