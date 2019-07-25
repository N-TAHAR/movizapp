@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-5">Profil</h2>
    <div class="row justify-content-center">
        <div class="profile-header-container text-center mb-3">
            <div class="profile-header-img">
                @if($user->avatar === "user.jpg")
                    <img class="rounded-circle mb-2" style="width:100px; height:100px;" src="https://uybor.uz/borless/avtobor/img/user-images/user_no_photo_300x300.png" />
                @else
                    <img class="rounded-circle mb-2" style="width:100px; height:100px;" src="/storage/avatars/{{ $user->avatar }}" />
                @endif
                <!-- badge -->
                <h3>{{$user->name}}</h3>
            </div>
        </div>
    </div>
    <h2 class="mb-5">Historic</h2>
    <ul class="list-group">
        @if(isset($historics))
        @if(count($historics) > 0)
            @foreach ($historics as $historic)
                @if ($historic->type === 'comment')
                <li class="list-group-item">
                    <p>{{$user->name}} the film <span class="font-weight-bold">{{ ($omdb->get_by_id( $historic->movie_id ))['Title'] }}</span>.</p>
                    <div>
                        <p class="m-0 p-3 bg-light text">{{ $historic->content }}</p>
                    </div>
                </li>
                @elseif ($historic->type === 'note')
                <li class="list-group-item">
                {{$user->name}} noted <span class="font-weight-bold">{{ $historic->content }}/10</span> the film <span class="font-weight-bold">{{ ($omdb->get_by_id( $historic->movie_id ))['Title'] }}</span>.
                </li>
                @endif
            @endforeach
        @else
        <h3 class="h5">No activity recently.</h3>
        @endif
        @endif
    </ul>
</div>

@endsection
