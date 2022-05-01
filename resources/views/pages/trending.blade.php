<?php
/**
 * @var array $trendingMovies
 */
?>

@section('trending')
<ul>
    <?php foreach ($trendingMovies as $trending): ?>
    <li class="sub">
        <div class="imageContainer">
            <p id="movieTitle" data-title="<?php echo $trending['Title'];?>"
               data-year="<?php echo $trending['Year'];?>">
            </p>
            <img class="image" id="searchImg" src="
                        <?php if($trending['Poster'] != "N/A")
            {
                echo $trending['Poster'];
            }
            else {
                echo "https://i.imgur.com/jHsym5q.png";
            }
            ?>"/>
        </div>
    </li>
    <?php endforeach; ?>
</ul>
@endsection
