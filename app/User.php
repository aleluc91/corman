<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'date_of_birth',
        'country' ,
        'gender' ,
        'affiliation' ,
        'lines_of_research',
        'avatar' ,
        'dblp_url',
        'privacy'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function author()
    {
        return $this->hasOne('App\Author' , 'dblp_url' , 'dblp_url');
    }

    public function groups(){
        return $this->belongsToMany(Group::class , 'group_user')->withPivot('role');
    }

    public function groupsRegistrationNotifications(){
        return $this->hasMany('\App\GroupRegistrationNotification');
    }

}
