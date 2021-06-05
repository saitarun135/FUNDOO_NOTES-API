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
    
}
