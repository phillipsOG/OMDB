<?php
/**
 * @var array $trendingMovies
 */
?>

@section('trending')
    <ul>
        <?php
        $counter = count($trendingMovies[0]) - 1;
        for($i = 0; $i < $counter; $i++) {?>
        <li class="sub">
            <div class="imageContainer">
                <p id="movieTitle" data-title="<?php echo $trendingMovies[0][$i]['Title'];?>"
                   data-year="<?php echo $trendingMovies[0][$i]['Year'];?>"
                   data-imdbID="<?php echo $trendingMovies[0][$i]['imdbID']; ?>">
                </p>
                <img class="image" id="searchImg" src="
                <?php if($trendingMovies[0][$i]['Poster'] != "N/A")
                {
                    echo $trendingMovies[0][$i]['Poster'];
                }
                else {
                    echo "https://i.imgur.com/jHsym5q.png";
                }
                ?>"/>
            </div>
        </li>
        <?php };?>
    </ul>
@endsection
