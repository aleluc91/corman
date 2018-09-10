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

    public function topics(){
        return $this->belongsToMany(Topic::class , 'publication_topic')->withTimestamps();
    }

    public function multimedias(){
        return $this->hasMany(Multimedia::class);
    }

    public function groups(){
        return $this->belongsToMany(Group::class , 'group_publication');
    }

}
