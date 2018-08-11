<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersProfileController extends Controller
{

    /**
     * UsersProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('users.profile');
    }

    public function edit(){
        return view();
    }

}
