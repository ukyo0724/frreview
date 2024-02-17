<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller{
    public function index(User $user){
        return view('users/index')->with(['posts'=>$user->getByUser()]);
    }
    
    public function commentIndex(User $user){
        return  view('comments.index')->with(['posts'=>$user->getByComment]);
    }
    
}