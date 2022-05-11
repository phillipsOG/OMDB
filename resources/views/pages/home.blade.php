

@extends('layouts.master')
@section('title', 'Home')
@section('homepage')
@section('description')
    @include('layouts.description')
@show
<div class="home-body">
    <h1>Movies</h1>
</div>
<div class="results-body">
    @section('trending')
        @include('pages.trending')
    @show
</div>
@endsection
