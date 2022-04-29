<?php
/**
 * @var array $searchResults
 */
?>

@extends('layouts.master')
@section('title', $_GET['movie_title'])
@section('returnedContent')
@parent
<div class="mainBody">
    <p id="test"><?php echo "Your searched for: ".$_GET['movie_title'];?></p>
    <ul>
        <?php foreach ($searchResults as $movie): ?>
        <li>
            <div class="imageContainer">
                <p id="movieTitle"><?php echo $movie['Title'];?></p>
                <p id="movieYear"><?php echo $movie['Year'];?></p>
                <div style="clear: left;"/>
                <img class="image" id="searchImg" src="<?php echo $movie['Poster']; ?>"/>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
@endsection
