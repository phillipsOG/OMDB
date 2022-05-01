

@extends('layouts.master')
@section('title', 'Home')
@section('homepage')
@section('description')
    @include('layouts.description')
@show
<div class="home-body">
    <h1>The Open Movie Database Project</h1>
    <p>Open Movie DB is a website for searching movie titles across genres and categories.</p>
</div>
<div class="results-body">
    @section('trending')
        @include('pages.trending')
    @show
</div>
@endsection
