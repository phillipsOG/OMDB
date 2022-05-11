<?php
/**
 * @var array $searchResults
 */
?>
@extends('layouts.description')
@extends('layouts.master')
@section('title', $_GET['movieTitle'])
@section('poster')
<div class="main-body">
    @section('description')
        @include('layouts.description')
    @show
    <div class="results-body">
        <h1 id="test">Movies</h1>
        <ul>
            <?php foreach ($searchResults as $movie): ?>
            <li class="sub">
                <div class="imageContainer">
                    <p id="movieTitle" data-title="<?php echo $movie['Title'];?>"
                         data-year="<?php echo $movie['Year'];?>"
                         data-imdbID="<?php echo $movie['imdbID']?>">
                    </p>
                    <img class="image" id="searchImg" src="<?php echo $movie['Poster']?>"/>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
@endsection
