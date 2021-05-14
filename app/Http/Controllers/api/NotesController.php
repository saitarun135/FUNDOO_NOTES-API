<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notes;
use App\Http\Resources\Note as NoteResource;
use Facade\FlareClient\Http\Response;
use Illuminate\Auth\Events\Validated;
use Dotenv\Validator;
use App\Http\Requests;

class NotesController extends Controller
{
  /* 
    protected $user;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = auth()->user();   
    }
   */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    public function display_All()
    {
        $notes=Notes::all();
        return new NoteResource($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_Note(Request $request)
    {
        $note=new Notes();
        $note->title=$request->input('title');
        $note->body=$request->input('body');
        $note->save();
        return new NoteResource($note);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function display_Note($id)
    {
        $note=Notes::findOrFail($id);
        return new NoteResource($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_Note(Request $request, $id)
    {
        $note=Notes::findOrFail($id);
        $note->title=$request->input('title');
        $note->body=$request->input('body');
        $note->save();
        return new NoteResource($note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_Note($id)
    {
        $note=Notes::findOrFail($id);
        if($note->delete()){
            return new NoteResource($note);
        }
        
    }
}
