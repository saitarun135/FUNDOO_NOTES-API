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
                              eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.
                              eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyMjg3NDA4MSwiZXhwIjoxNjIyODc3NjgxLCJuYmYiOjE2MjI4NzQwODEsImp0aSI6ImM5Q1M0NGhNTUt6V2M4MVMiLCJzdWIiOjc4LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.PqZsRD0H3johhpD_wD9spwmr0qDDJTcuDO9CmUYyVjI'
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
            'Authorization'=>'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyMjg4NzAwNSwiZXhwIjoxNjIyODkwNjA2LCJuYmYiOjE2MjI4ODcwMDYsImp0aSI6Im90UWh2NzAwRU1VZ0EwMWkiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.UsKdEv_5buj0qUdZS0kQffgaWSs_Fq56PLOsW5ZdfjE'
        
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
             'Authorization'=>'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYyMjg4NzAwNSwiZXhwIjoxNjIyODkwNjA2LCJuYmYiOjE2MjI4ODcwMDYsImp0aSI6Im90UWh2NzAwRU1VZ0EwMWkiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.UsKdEv_5buj0qUdZS0kQffgaWSs_Fq56PLOsW5ZdfjE'
            ])->json('DELETE','http://127.0.0.1:8000/api/deleteNote/17');
            $response->assertStatus(201)->assertExactJson(['message'=>'Deleted']);
     }

}
