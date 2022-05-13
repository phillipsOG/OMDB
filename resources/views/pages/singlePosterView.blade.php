<?php
/**
 * @var array $movieData
 */
?>
@extends('layouts.master')
@section('title', $movieData['title'])
@section('singlePosterView')
    <div class="main-body">
        <div class="results-body-single-view">
            <ul>
                <li>
                    <div class="imageContainer">
                        <p id="movieTitle" data-title="<?php echo $movieData['title'];?>"
                           data-year="<?php echo $movieData['year'];?>">
                        </p>
                        <img class="image posterImage singleView" src="<?php echo $movieData['posterUrl']; ?>" alt="movie poster"/>
                    </div>
                </li>
            </ul>
            <div class="box-office" id="box-office">
                <p id="m-title"><?php echo $movieData['title'];?></p>
                <p id="m-genre-data"><?php echo $movieData['genre'];?></p>
                <table>
                    <tr>
                        <th>IMDB Rating</th>
                        <th>Year</th>
                        <th>Box office</th>
                    </tr>
                    <tr>
                        <td id="m-rating"><image id="imdb-star" src="https://i.imgur.com/L9hNySh.png"></image>
                            <p id="m-rating-data"> <?php echo $movieData['rating'];?></p></td>
                        <td id="m-year"><?php echo $movieData['year'];?></td>
                        <td><?php echo $movieData['boxOffice'];?></p></td>
                    </tr>
                </table>
                <p id="m-director-title">Director</p>
                <p id="m-director-data"><?php echo $movieData['director'];?></p>
                <p id="m-summary-title">Summary</p>
                <p id="m-summary-data"><?php echo $movieData['summary'];?></p>
                <p id="m-actors-title">Lead actors</p>
                <p id="m-actors-data"><?php echo $movieData['actors'];?></p>
            </div>
        </div>
    </div>
@endsection
