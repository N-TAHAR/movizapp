<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Historic;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }

    public function store($movie_id){
        Note::create([
            'user_name' => Auth::user()->name,
            'movie_id' => $movie_id,
            'note' => request('note')
        ]);

        Historic::create([
            'user_name' => Auth::user()->name,
            'movie_id' => $movie_id,
            'content' => request('note'),
            'type' => 'note',
        ]);

        return back()
            ->with('success','You have successfully note the film.');
    }
}
