<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Labels;
use App\LabelsNotes;
use App\Models\Notes;
use Illuminate\Validation\Rule;
use Tymon\JWTAuth\Validators\Validator;

class Labelcontroller extends Controller
{
    public function makeLabel(Request $req)
    {

        $label['label'] = $req->get('label');
        $label['user_id'] = Auth::user()->id;

        $messages = [
            'label.unique' => 'Duplicate label',
        ];

        //validation for duplicate label of the same user
        $validator = Validator::make(
            $label,
            [
                'label' => [
                    'required',
                    Rule::unique('labels')->where(function ($query) use ($label) {
                        return $query->where('label', $label['label'])
                            ->where('user_id', $label['user_id']);
                    }),
                ],
            ],
            $messages
        );

        //return proper response if duplicate entry is there
        if ($validator->fails()) {
            $err = $validator->errors();
            return response()->json(['message' => 'error: duplicate label'], 210);
        }


        //create a new label
        $label['label'] = $req->get('label');
        $label['user_id'] = Auth::user()->id;
        $ll = Labels::create($label);
        return response()->json(['message' => 'created', 'label' => $ll], 200);
    }

    /**
     * function to delete a label from user
     */
    public function deleteLabel(Request $req)
    {
        if (Labels::destroy($req->get('labelid')) > 0) {
            return response()->json(['message' => 'label deleted'], 200);
        } else {
            return response()->json(['message' => 'label not found'], 204);
        }
    }
    /**
     * function to edit the label 
     * @param Request 
     * @return json object
     */
    public function editLabel(Request $req)
    {
        $label = Labels::where('id', $req->get('labelid'))->first();
        if ($label !== null) {
            $label->update(
                [
                    'label' => $req->get('label'),
                ]
            );
            return response()->json(['label' => $label, 'notes' => Notes::getUserNotes()], 200);
        } else {
            return response()->json(['message' => 'Label Not Found', 204]);
        }
    }   


    /**
     * function to add the label to the given note
     * @param Request 
     * @return json object of labels_notes
     */
     public function addNoteLabel(Request $req){

        //request contains the following values
        $label['labelid'] = $req->get('labelid');
        $label['noteid'] = $req->get('noteid');
        $label['user_id'] = Auth::user()->id;

        //declaring message for the customize error validation
        $messages = [
            'labelid.unique' => 'Note Already have a label'
        ];

            //validation for duplicate label of the same user
            $validator = Validator::make(
            $label,
            [
                'labelid' => [
                    'required',
                    Rule::unique('labels_notes')->where(function ($query) use ($label) {
                        return $query->where('labelid', $label['labelid'])
                            ->where('noteid', $label['noteid']);
                    }),
                ],
            ],
            $messages
        );
            //if validator fails means that the label is already added to the note
            if ($validator->fails()) {
            $err = $validator->errors();
            //the it returns the error in the response 
            return response()->json(['message' => $err], 210);
        }
         //or map the label to the note 
         LabelsNotes::create($label);
        
        //fetching the newly added note from the database
         $note = Notes::with('labels')->where('id', $req->get('noteid'));
         return response()->json(['note'=>$note->get()], 200);
    } 
       
    /**
     * function to delete the label from the note 
     * 
     * @var req Request 
     */
    public function deleteNoteLabel(Request $req)
    {
        $label['labelid'] = $req->get('labelid');
        $label['noteid'] = $req->get('noteid');
        $messages = [
            'labelid.unique' => 'Note has this label',
        ];

        //validation for duplicate label of the same user
        $validator = Validator::make(
            $label,
            [
                'labelid' => [
                    'required',
                    Rule::unique('labels_notes')->where(function ($query) use ($label) {
                        return $query->where('labelid', $label['labelid'])
                            ->where('noteid', $label['noteid']);
                    }),
                ],
            ],
            $messages
        );
        if ($validator->fails()) {
            $ll = LabelsNotes::where('labelid', $label['labelid'])->where('noteid',$label['noteid'])->first();
            $ll->delete();
            $note = Notes::with('labels')->where('id', $label['noteid'])->get();
            return response()->json(['note'=>$note], 200);
        }
        else{
            return response()->json(['message' => 'label not found'], 210);
        }
        
    }
}
