<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabelsNotes extends Model
{
 protected $fillable = [
        'labelid', 'user_id','noteid' 
    ];

    protected $with = ['labelname'];

    public function labelname()
    {
        return $this->belongsTo('App\Models\Labels', 'labelid');
    }}