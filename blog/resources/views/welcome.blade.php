@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Home</h1>
        <div class="col-md-5">
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

@endsection
