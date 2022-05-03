<?php
/**
 * @var array $movieDesc
 */
?>
@extends('layouts.master')
@section('title', $movieDesc['Title'])
@section('singlePosterViewNY')
    <div class="main-body">
        <div class="results-body">
            <p id="test"><?php echo "Your searched for: ".$movieDesc['Title']?></p>
            <ul>
                <li class="sub">
                    <div class="imageContainer">
                        <p id="movieTitle" data-title="<?php echo $movieDesc['Title'];?>"
                           data-year="<?php echo $movieDesc['Year'];?>">
                        </p>
                        <img class="image" id="searchImg" src="
                        <?php if($movieDesc['Poster'] != "N/A")
                        {
                            echo $movieDesc['Poster'];
                        }
                        else {
                            echo "https://i.imgur.com/jHsym5q.png";
                        }
                        ?>"/>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection
