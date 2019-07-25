@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">Account</h1>
    <h2 class="mb-5">Profil</h2>
    <div class="row">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="profile-header-container text-center mb-3">
            <div class="profile-header-img">
                @if(Auth::user()->avatar === "user.jpg")
                    <img class="rounded-circle mb-2" style="width:100px; height:100px;" src="https://uybor.uz/borless/avtobor/img/user-images/user_no_photo_300x300.png" />
                @else
                    <img class="rounded-circle mb-2" style="width:100px; height:100px;" src="/storage/avatars/{{ Auth::user()->avatar }}" />
                @endif
                <!-- badge -->
                <h3>{{Auth::user()->name}}</h3>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-5">
        <form action="/account" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <h2 class="mb-5">Historic</h2>
    <ul class="list-group">
        @if(isset($historics))
        @if(count($historics) > 0)
            @foreach ($historics as $historic)
                @if ($historic->type === 'comment')
                <li class="list-group-item">
                    <p>You commented the film <span class="font-weight-bold">{{ ($omdb->get_by_id( $historic->movie_id ))['Title'] }}</span>.</p>
                    <div>
                        <p class="m-0 p-3 bg-light text">{{ $historic->content }}</p>
                    </div>
                </li>
                @elseif ($historic->type === 'note')
                <li class="list-group-item">
                    You noted <span class="font-weight-bold">{{ $historic->content }}/10</span> the film <span class="font-weight-bold">{{ ($omdb->get_by_id( $historic->movie_id ))['Title'] }}</span>.
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
