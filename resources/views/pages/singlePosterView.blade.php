<?php
/**
 * @var array $movieDesc
 */
?>
@extends('layouts.master')
@section('title', $movieDesc['Title'])
@section('singlePosterView')
    <div class="main-body">
        <div class="results-body">
            <p class="title" id="test"><?php echo "Your searched for: ".$movieDesc['Title']?></p>
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
            <div class="box-office" id="box-office">
                <?php
                    echo $movieDesc['Title'];
                    echo "<br><br>";
                    echo $movieDesc['Genre'];
                    echo "<br><br>";
                    echo "Rating " . $movieDesc['imdbRating'];
                    echo "<br><br>";
                    if(isset($movieDesc['BoxOffice'])) { echo "Box Office " . $movieDesc['BoxOffice'] . "<br><br>";}
                    echo "Released " . $movieDesc['Released'];
                    echo "<br><br>";
                    echo "Director " . $movieDesc['Director'];
                    echo "<br><br>";
                    echo "Summary<br><br>" . $movieDesc['Plot'];
                ?>
            </div>
        </div>
    </div>
@endsection
