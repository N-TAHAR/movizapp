@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Movizapp</h1>
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

    <h2 class="mb-5">Latest movies commented</h2>
    <div class="row justify-content-between">
        @if (isset($historics))
            @if (count($historics) > 0)
                @foreach($historics as $historic)
                    <div class="col-lg mb-5 flex-grow-0 d-flex flex-column justify-content-between align-items-center">
                        <a class="text-center" href="{{ route('movie', ['id_movie' => ($omdb->get_by_id( $historic->movie_id ))['imdbID'] ]) }}">
                            <img class="mb-2" src="{{ ($omdb->get_by_id( $historic->movie_id ))['Poster'] }}">
                            <h5 class="link">{{ ($omdb->get_by_id( $historic->movie_id ))['Title'] }}</h5>
                        </a>
                    </div>
                @endforeach
            @else 
            <h3 class="col-lg h5">No movie commented.</h3>
            @endif
        @endif
    </div>
</div>
@endsection
