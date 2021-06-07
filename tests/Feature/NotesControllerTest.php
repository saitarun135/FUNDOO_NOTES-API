<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Notes;
use App\Http\Controllers\api\NotesController;
use Laravel\passport\passport;

class NotesControllerTest extends TestCase
{
    /**
     * testing valid user able to create Notes
     *
    */
    public function test_NoteCreate()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer 
            eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyMjg5MjA0MywiZXhwIjoxNjIyODk1NjQ0LCJuYmYiOjE2MjI4OTIwNDQsImp0aSI6IjdUZGY3OVMxOHQxZDJGYTIiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.UZoDqQk8Oxysi4fWVo0trMSyduX3GZDB_9k_9iO1OcY'
        ])->json('POST', '/api/createNote', [
            'title'=>'notes testing',
            'body'=>'writing test cases',
        ]);
     $response->assertStatus(201);
    }

    /**
    * Testing for get Notes of a specific user
    */
    
    public function test_GetAllNotes(){
        $response = $this->withHeaders([
            'Content-Type' => 'Application/json',
            'Authorization'=>'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyMjg5MjA0MywiZXhwIjoxNjIyODk1NjQ0LCJuYmYiOjE2MjI4OTIwNDQsImp0aSI6IjdUZGY3OVMxOHQxZDJGYTIiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.UZoDqQk8Oxysi4fWVo0trMSyduX3GZDB_9k_9iO1OcY'
        
        ])->json('GET', '/api/displayNotes');
        
        $response->assertStatus(200)->assertSuccessful();
    }

    /**
    *Test case for deleting a note of a particular user 
    * saitarun800@gmail.com
    */
    
    public function test_deleteNotes(){
         $response=$this->withHeaders([
             'Content-Type'=>'Application/json',
             'Authorization'=>'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyMjg5MjA0MywiZXhwIjoxNjIyODk1NjQ0LCJuYmYiOjE2MjI4OTIwNDQsImp0aSI6IjdUZGY3OVMxOHQxZDJGYTIiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.UZoDqQk8Oxysi4fWVo0trMSyduX3GZDB_9k_9iO1OcY'
        ])->json('DELETE','http://127.0.0.1:8000/api/deleteNote/18');
            $response->assertStatus(201)->assertExactJson(['message'=>'Deleted']);
     }

    /**
     *testing for the updating note 
     *saitarun800@gmail.com
    */ 

    public function test_UpadteNotes_By_ID(){
        $response=$this->withHeaders([
            'Content-Type'=>'Application/json',
            'Authorization'=>'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyMjg5MjA0MywiZXhwIjoxNjIyODk1NjQ0LCJuYmYiOjE2MjI4OTIwNDQsImp0aSI6IjdUZGY3OVMxOHQxZDJGYTIiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.UZoDqQk8Oxysi4fWVo0trMSyduX3GZDB_9k_9iO1OcY'
       ])->json('PUT','http://127.0.0.1:8000/api/updateNote/19',[
           "title"=>"tarun-sai",
           "body"=>"justnow-updated"
       ]);
        $response->assertStatus(200);
    }

}
