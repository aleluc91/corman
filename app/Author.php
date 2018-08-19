<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    protected $fillable = [
        'name' , 'dblp_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User' , 'dblp_id' , 'dblp_id');
    }

    public function publications()
    {
        return $this->belongsToMany(Publication::class, 'author_publication')->withTimestamps();
    }

}
