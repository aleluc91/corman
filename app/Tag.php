<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = [
        'tag'
    ];

    public function publications(){
        return $this->hasMany(Publication::class);
    }
}
