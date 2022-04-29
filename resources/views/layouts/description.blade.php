<?php
/**
 * @var array $movieDesc
 */
?>

@extends('layouts.master')
@section('title', 'Description')
@section('description')
    @parent
    <desc class="description" id="movieDesc">
        <p>Dummy description</p>

    </desc>
@endsection
