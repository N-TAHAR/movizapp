<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\OMDb;
use Illuminate\Support\Facades\DB;
use App\User;

class AccountController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function historic(){
        $historics = DB::table('historics')->where('user_name', Auth::user()->name)->latest()->get();
        $omdb = new OMDb( ['tomatoes' => TRUE, 'apikey' => env('OMDB_API_KEY', false)] );
        return view('account', ['historics' => $historics, 'omdb' => $omdb]);
    }

    public function historicGuest($id){
        $user = User::where('id', $id)->first();
        $historics = DB::table('historics')->where('user_name', $user->name)->latest()->get();
        $omdb = new OMDb( ['tomatoes' => TRUE, 'apikey' => env('OMDB_API_KEY', false)] );
        return view('user', ['historics' => $historics, 'omdb' => $omdb, 'user' => $user]);
    }

    public function update_avatar(Request $request){
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('avatars',$avatarName);

        $user->avatar = $avatarName;
        $user->save();

        return back()
            ->with('success','You have successfully upload image.');

    }
}
