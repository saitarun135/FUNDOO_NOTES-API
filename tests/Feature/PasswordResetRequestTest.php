<?php

namespace Tests\Feature;

use App\Http\Controllers\PasswordResetRequestController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Feature\factory;

use Faker\Factory as Faker;

class passwordResetRequestTest extends TestCase
{
    /**
     * checks email with DB and create a success msg
    */
    public function test_ForgotPasswordCreateSuccess(){
        $response = $this->withHeaders([
            'content-Type' =>'Application/json'
            ])->json('POST','/api/auth/sendPasswordResetLink',[
               'email' => 'saitarun800@gmail.com'
            ]);
        $response->assertStatus(200)
            ->assertExactJson(['data' => 'Reset link is send successfully, please check your inbox.']);
    }
    
    /**
    * checks weather the email is valid or not 
    */
    public function test_ForgotPasswordCreateFailure(){
        $response = $this->withHeaders([
            'Content-Type' => 'Application/Json'
            ])->json('Post','/api/auth/sendPasswordResetLink',[
                'email' =>'johnjo@gmail.com'
            ]);
        $response->assertStatus(404)
            ->assertExactJson(
            ['error' => 'Email does\'t found on our database']);
        }
    
    
    /**
    *basic code  for testing 
    */
    public function test_Forgot_Password_SendLink(){   
        $response = $this->json('POST','/api/auth/sendPasswordResetLink', [ 
            "email"=>"sravani@gmail.com"
        ]);
            $response->assertStatus(200);
        }
}
