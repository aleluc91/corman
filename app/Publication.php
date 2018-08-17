<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    //

    public function authors(){
        return $this->belongsToMany(Author::class , 'author_publication')->withTimestamps();
    }

    protected $fillable = [
       'dblp_id' , 'title' , 'venue' , 'volume' , 'number' , 'publisher' , 'pages' , 'year' , 'type' , 'key' , 'doi' , 'ee' , 'url'
    ];

}
