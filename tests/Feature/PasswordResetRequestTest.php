<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;
use \Assortmen;

use Test\Feature\factory;



class PasswordResetRequestTest extends TestCase
{
   /**
   * if token misses 
   */
    public function test_Forgot_Password_withNo_Token(){
                
        $response = $this->json('POST','/api/sendPasswordResetLink', [
            
            "email"=>"saitarun800@gmail.com"
        ]);
        $response->assertStatus(404);
   
       }
    
}
