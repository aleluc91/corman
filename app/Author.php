<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //

    public function publications()
    {
        return $this->belongsToMany(Publication::class, 'author_publication')->withTimestamps();
    }

    protected $fillable = [
        'name' , 'dblp_id'
    ];

}
