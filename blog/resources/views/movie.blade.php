@extends('layouts.app')

@section('content')
    <div class="container">
      @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
          </div>
      @endif
      <h1>{{ $posts['Title'] }}</h1>
      <div class="row mb-5">
        <div class="col-lg flex-grow-0 mb-5">
          <img src="{{ $posts['Poster'] }}" alt="">
        </div>
        <div class="col-lg">
          <ul class="row list-unstyled ml-0">
            <li class="font-weight-bold">Production :</li>
            <ul>
            @if (is_array($posts['Writer']))
              @foreach ($posts['Writer'] as $post)
                <li> {{$post}} </li>
              @endforeach
            @else
              <li> {{$posts['Writer']}} </li>
            @endif
            </ul>
          </ul>
          <ul class="row list-unstyled ml-0">
            <li class="font-weight-bold">Genre :</li>
            <ul>
            @if (is_array($posts['Genre']))
              @foreach ($posts['Genre'] as $post)
                <li> {{$post}} </li>
              @endforeach
            @else
              <li> {{$posts['Genre']}} </li>
            @endif
            </ul>
          </ul>
          <ul class="row list-unstyled ml-0">
            <li class="font-weight-bold">Origin :</li>
            <ul>
            @if (is_array($posts['Country']))
              @foreach ($posts['Country'] as $post)
                <li> {{$post}} </li>
              @endforeach
            @else
              <li> {{$posts['Country']}} </li>
            @endif
            </ul>
          </ul>
          <p><span class="font-weight-bold">Year :</span> {{$posts['Year']}} </p>
          <p><span class="font-weight-bold">Notation :</span> {{$posts['imdbRating']}} / 10</p>
          <p><span class="font-weight-bold">Synopsis :</span><br>{{$posts['Plot']}}</p>
        </div>
      </div>
      @guest
      <div class="row justify-content-center align-items-center mb-5">
        <span class="mr-3">Log in to comment and note</span>
        <a class="btn btn-primary" href="/login">Log in</a>
      </div>
      @else
        @if(isset($notes))
        <div class=" mb-5">
          <p class="mr-3">You noted the film <span class="font-weight-bold">{{$notes->note}}/10</span>.</p>
        </div>
        @else
        <div class="col-lg-3 col-md-4 col-sm-5 col-8">
          <form action="{{ route('movie/notes', ['movie_id' => $posts['imdbID']]) }}" class="form-group mb-5 d-flex align-items-center" method="POST">
            {{csrf_field()}}
            <input type="number" class="form-control mr-2" name="note" value="5" min="0" max="10" required>
            <span class="mr-3 h5 mb-0">/10</span>
            <button class="btn btn-primary">Note</button>
          </form>
        </div>
        @endif
      <form action="{{ route('movie/comments', ['movie_id' => $posts['imdbID']]) }}" class="form-group mb-5" method="POST">
        {{csrf_field()}}
        <textarea class="form-control mb-2" name="comment" placeholder="Your comment here..." cols="30" rows="3" required></textarea>        
        <button class="btn btn-primary">Comment</button>
      </form>
      @endguest
      @if (count($comments) > 0)
      @foreach($comments as $comment)
      <div class="card mb-3 p-3">
        <div class="border-bottom pb-2 d-flex justify-content-between align-items-center">
          <div class="row align-items-center">
            <div class="profile-header-container mr-2 ml-3">
                <div class="profile-header-img">
                  @foreach($users as $user)
                    @if($user->name === $comment->user_name and $user->avatar === 'user.jpg')
                      <img class="rounded-circle" width="30px" height="30px" src="https://uybor.uz/borless/avtobor/img/user-images/user_no_photo_300x300.png"/>
                    @elseif ($user->name === $comment->user_name)
                      <img class="rounded-circle" width="30px" height="30px" src="/storage/avatars/{{ $user->avatar }}"/>
                    @endif
                  @endforeach
                </div>
            </div>
            <span class="font-weight-bold">{{ $comment->user_name }}</span> - {{$comment->created_at->diffForHumans()}}
          </div>
          <div>

            @if(isset($likes))
              @foreach($likes as $like)
                @if ($like->comment_id === $comment->id)
                  <span>{{$like->total}} likes</span>
                @endif
              @endforeach
            @else
              <span>0 likes</span>
            @endif
            <a class="btn btn-secondary" href="{{ route('movie/likes', ['comment_id' => $comment->id]) }}"  onsubmit="return checkForm(this);">J'aime</a>
            @if(isset(Auth::user()->name))
              @if(Auth::user()->name === $comment->user_name)
              <a class="btn btn-danger" href="{{ route('movie/comments/delete', ['comment_id' => $comment->id]) }}">Delete</a>
              @endif
            @endif
          </div>
        </div>
        <div class="card-body">
          {{$comment->comment}}
        </div>
      </div>
      @endforeach
      @endif

    </div>
@endsection