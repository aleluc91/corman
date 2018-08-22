<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    //
    protected $fillable = [
        'dblp_id' ,
        'title' ,
        'venue' ,
        'volume' ,
        'number' ,
        'publisher' ,
        'pages' ,
        'year' ,
        'type' ,
        'key' ,
        'doi' ,
        'ee' ,
        'url',
        'description',
        'tags'
    ];

    public function authors(){
        return $this->belongsToMany(Author::class , 'author_publication')->withTimestamps();
    }

    public function publication_tags(){
        return $this->belongsToMany(Tag::class , 'publication_tag')->withTimestamps();
    }

}
