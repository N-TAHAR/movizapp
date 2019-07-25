<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Comment;
use App\Historic;
use Auth;


class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }

    public function store($movie_id){
        Comment::create([
            'user_name' => Auth::user()->name,
            'movie_id' => $movie_id,
            'comment' => request('comment')
        ]);

        Historic::create([
            'user_name' => Auth::user()->name,
            'movie_id' => $movie_id,
            'content' => request('comment'),
            'type' => 'comment',
        ]);

        return back()
            ->with('success','You have successfully create your comment.');
    }

    public function delete($comment_id){
        $comment = Comment::where('id', $comment_id)->first();
        var_dump($comment->comment);
        $comment->delete();
        return back()
            ->with('success','You have successfully delete your comment.');
    }
}