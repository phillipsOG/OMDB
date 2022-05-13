

@extends('layouts.master')
@section('title', 'Home')
@section('homepage')
@section('description')
    @include('layouts.description')
@show
@section('trending')
    @include('pages.trending')
@show
@endsection
