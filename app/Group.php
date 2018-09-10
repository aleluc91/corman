<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $fillable = array('name' , 'description' , 'image_url');

    public function publications(){
        return $this->belongsToMany(Publication::class , 'group_publication');
    }

    public function users(){
        return $this->belongsToMany(User::class , 'group_user')->withPivot('role');
    }


}
