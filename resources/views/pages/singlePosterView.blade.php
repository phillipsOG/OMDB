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
                    /*1.2682
                    $noDolla = substr($movieDesc['BoxOffice'], 1, strlen($movieDesc['BoxOffice']));
                    $noDolla = (int)$noDolla;
                    //we want approx. 95,156,989.61
                    $fmt = numfmt_create( 'en_GB', NumberFormatter::CURRENCY );
                    $noDollaFormatted = numfmt_format_currency($fmt, ($noDolla/1.2489), "GBP");
                    echo "Box Office £" . $noDollaFormatted . "<br><br>";*/
                    echo "<br><br>";
                    echo "Released " . $movieDesc['Year'];
                    echo "<br><br>";
                    if(isset($movieDesc['BoxOffice'])) { echo "Box Office " . "<br><br>".
                    $movieDesc['BoxOffice'];}
                    echo "<br><br>";
                    echo "Director " . "<br><br>" . $movieDesc['Director'];
                    echo "<br>";
                    ?>
                    <p id="m-summary"><?php
                    echo "Summary<br><br>" . $movieDesc['Plot'] . "<br><br>";
                    echo "Lead actors<br><br>" . $movieDesc['Actors'];
                    ?></p>
            </div>
        </div>
    </div>
@endsection
