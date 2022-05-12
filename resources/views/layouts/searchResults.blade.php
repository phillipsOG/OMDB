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
        <?php foreach($searchResults as $movie): ?>
        <table class="trending-table">
            <tr>
                <td class="trending-table-td">
                    <div class="imageContainer" data-title="<?php echo $movie['Title'];?>"
                         data-year="<?php echo $movie['Year'];?>"
                         data-imdbID="<?php echo $movie['imdbID']; ?>">
                        <img class="image" id="searchImg" src="
                        <?php echo $movie['Poster'];?>"/>
                    </div>
                </td>
            </tr>
        </table>
        <?php endforeach; ?>
    </div>
</div>
@endsection
