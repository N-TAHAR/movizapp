<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
USE Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{

    public function store($comment_id){

        Like::create([
            'user_id' => Auth::user()->id,
            'comment_id' => $comment_id,
        ]);
        
        return back();
    }
}
