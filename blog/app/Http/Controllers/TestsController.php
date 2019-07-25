<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Imdb;
use App\OMDb;
use App\User;   
use App\Comment;
use App\Note;
use App\Historic;
use App\Like;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\Console\Logger\ConsoleLogger;

class TestsController extends Controller
{
    public function list(Request $request){
        $omdb = new OMDb( ['tomatoes' => TRUE, 'apikey' => env('OMDB_API_KEY', false)] );
        $search = $request->get('search');
        $posts = $omdb->search($search);
        $users = User::where('name', $search)->get();
        if($posts['Response'] === true){
            return view('search', ['posts' => $posts['Search'], 'users' => $users]);
        } else {
            return view('search', ['error' => 'Film not found']);
        }
    }

    public function movie($movie_id){
        $omdb = new OMDb( ['tomatoes' => TRUE, 'apikey' => env('OMDB_API_KEY', false)] );
        $posts = $omdb->get_by_id( $movie_id );
        $comments = Comment::where('movie_id', $movie_id)->latest()->get();
        $likes = DB::table('likes')
                 ->select('comment_id', DB::raw('count(*) as total'))
                 ->groupBy('comment_id')
                 ->get();
        $users = User::all();
        if (isset(Auth::user()->name)) {
            $notes = Note::where('movie_id', $movie_id)->where('user_name', Auth::user()->name)->first();
            return view('movie', ['posts' => $posts, 'comments' => $comments, 'likes' => $likes, 'users' => $users, 'notes' => $notes]);
        }
        return view('movie', ['posts' => $posts, 'comments' => $comments, 'users' => $users, 'likes' => $likes]);
    }

    public function home(){
        $historics = Historic::where('type', 'comment')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->unique('movie_id');
        $omdb = new OMDb( ['tomatoes' => TRUE, 'apikey' => env('OMDB_API_KEY', false)] );
        return view('home', ['historics' => $historics, 'omdb' => $omdb]);
    }
}
