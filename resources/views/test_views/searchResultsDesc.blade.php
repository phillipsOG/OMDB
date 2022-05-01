<?php
/**
 * @var array $movieDesc
 */
?>
@extends('layouts.master')
@section('title', 'Title')
@section('sRD')
    <div class="mainBody">
        <p id="test"><?php echo "Your searched for: ".$movieDesc['Title']?></p>
        <ul>
            <li>
                <div class="imageContainer">
                    <p id="movieTitle"><?php echo $movieDesc['Title'];?></p>
                    <p id="movieYear"><?php echo $movieDesc['Year'];?></p>
                    <div style="clear: left;"/>
                    <img class="image" id="searchImg" src="<?php echo $movieDesc['Poster']; ?>"/>
                </div>
            </li>
        </ul>
    </div>
@endsection
