@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Result Search</h1>
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-5 mb-5">
            <form action="/search" method="get">
                <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <h2 class="mb-5">Users</h2>
    <div class="row justify-content-between">
        @if (isset($users))
            @if (count($users) > 0)
                @foreach($users as $user)
                <a href="{{ route('user', ['user' => $user]) }}">
                    <div class="col-lg mb-5 flex-grow-0 d-flex flex-column justify-content-between align-items-center">
                        @if($user->avatar === 'user.jpg')
                            <img class="rounded-circle" width="50px" height="50px" src="https://uybor.uz/borless/avtobor/img/user-images/user_no_photo_300x300.png"/>
                        @else
                            <img class="rounded-circle" width="50px" height="50px" src="/storage/avatars/{{ $user->avatar }}"/>
                        @endif
                        <h3>{{$user->name}}</h3>
                    </div>
                </a>
                @endforeach
            @else 
            <h3 class="col-lg h5">No users.</h3>
            @endif
        @endif
    </div>
    <h2 class="mb-5">Films</h2>
        <div class="row justify-content-between">
            @if (isset($posts))
                @foreach($posts as $post)
                    @if ($post['Type'] === 'movie' && isset($post['Poster']))
                        <div class="col-lg mb-5 flex-grow-0 d-flex flex-column justify-content-between align-items-center">
                            <a href="{{ route('movie', ['id_movie' => $post['imdbID']]) }}">
                                <img class="mb-2" src="{{$post['Poster']}}">
                                <h5>{{$post['Title']}}</h5>
                            </a>
                        </div>
                    @endif
                @endforeach
            @else
            <h5>{{ $error }}</h5>
            @endif
        </div>
    </div>
@endsection
