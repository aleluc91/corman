<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    protected $fillable = [
        'name' , 'dblp_url'
    ];

    public function user()
    {
        return $this->belongsTo('App\User' , 'dblp_url' , 'dblp_url');
    }

    public function publications()
    {
        return $this->belongsToMany(Publication::class, 'author_publication')->withTimestamps();
    }

}
