<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    //
    protected $fillable = array('url' , 'type' , 'publication_id');

    public function publication(){
        return $this->belongsTo(Publication::class);
    }
}
