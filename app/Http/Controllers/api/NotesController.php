<?php
//-->http error coded -->https://www.tutorialspoint.com/http/http_status_codes.htm
namespace App\Http\Controllers\api;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notes;
use App\Models\User;
use App\Http\Resources\Note as NoteResource;
use Facade\FlareClient\Http\Response;
use Illuminate\Auth\Events\Validated;
use Dotenv\Validator;
use App\Http\Requests;

class NotesController extends Controller
{
    
    public function display_All()
    {

        $notes=Notes::all();
        return User::find($notes->user_id=auth()->id())->noteses;  //finding based on id
        //$note=new Notes();                //note obj
        //return new NoteResource($notes);           it displays all users notes
        // return User::find(7)->noteses;            it is hardcoded id
    }

    public function create_Note(Request $request)
    {
        $note=new Notes();
        $note->title=$request->input('title');
        $note->body=$request->input('body'); 
        $note->user_id = auth()->id();          //userid added automatically from the usertable to NotesTable 
        $note->save();
        return new NoteResource($note);
    }

    public function display_Note($id)
    {
        $note=Notes::findOrFail($id);
        if($note->user_id==auth()->id())
            return new NoteResource($note);
        else{
            return response()->json([
                'error' => 'UnAuthorized/invalid id'], 401);
                //echo "unauthorized";
            }
    }


    public function update_Note(Request $request, $id)
    {
        $note=Notes::findOrFail($id);
        if($note->user_id==auth()->id()){
            $note->title=$request->input('title');
            $note->body=$request->input('body');
            $note->save();
            return new NoteResource($note);
        }
        else
        {
            echo "Note is not available with that id";
        }
    }

    public function delete_Note($id)
    {
        $note=Notes::findOrFail($id);
        if($note->user_id==auth()->id()){
            if($note->delete()){
                return response()->json(['message'=>'Deleted'],201);
                //return new NoteResource($note);
            }
        }
        else{
            return response()->json([
                'error' => ' Method Not Allowed/invalid note id'], 405);
        }
    }
 /* 
    protected $user;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = auth()->user();   
    }
   */
//   public function list(){
//            //echo "All notes";     
//           //return Notes::all();
//        //  return Notes::find(4)->user;
//         // return User::all();
//        // return User::find(30);
//       // return Notes::all();
//       // return Notes::find(32)->noteses;
//       return User::find(32)->noteses;
//   }
}
