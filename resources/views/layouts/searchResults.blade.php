<?php
/**
 * @var array $searchResults
 */
?>
@extends('layouts.description')
@extends('layouts.master')
@section('title', $_GET['movieTitle'])
@section('searchResults')
<div class="main-body">
    @section('description')
        @include('layouts.description')
    @show
    <div class="results-body">
        <h1 id="test">You searched for: <?php echo $_GET['movieTitle'];?></h1>
        <?php foreach($searchResults as $movie): ?>
        <table class="trending-table">
            <tr>
                <td class="trending-table-td">
                    <div class="imageContainer" data-title="<?php echo $movie['Title'];?>"
                         data-year="<?php echo $movie['Year'];?>"
                         data-imdbID="<?php echo $movie['imdbID']; ?>">
                        <img class="image posterImage" src="<?php echo $movie['Poster'];?>"/>
                    </div>
                </td>
            </tr>
        </table>
        <?php endforeach; ?>
    </div>
</div>
@endsection
