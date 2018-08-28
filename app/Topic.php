<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function publications(){
        return $this->belongsToMany(Publication::class)->withTimestamps();
    }
}
