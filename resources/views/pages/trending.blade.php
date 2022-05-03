<?php
/**
 * @var array $trendingMovies
 */
?>

@section('trending')
    <ul>
        <?php
        $keys = array_keys($trendingMovies);
        for($i = 0; $i < count($keys); $i++)
        {?>
        <?php foreach($trendingMovies[$keys[$i]] as $trending): ?>
        <li class="sub">
            <div class="imageContainer">
                <p id="movieTitle" data-title="<?php echo $trending['Title'];?>"
                   data-year="<?php echo strlen($trending['Year']) > 4 ? substr($trending['Year'], 0, -7) : substr($trending['Year'], -4);?>">
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
        <?php };?>
    </ul>
@endsection
