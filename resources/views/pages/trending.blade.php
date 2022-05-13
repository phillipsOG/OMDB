<?php
/**
 * @var array $trendingMovies
 */
?>

@section('trending')
    <div class="results-body">
        <h1>Movies</h1>
        <?php foreach($trendingMovies as $key => $trendingMovie): ?>
            <table class="trending-table">
                <tr>
                    <td class="trending-table-td">
                        <div class="imageContainer" data-title="<?php echo $trendingMovie['Title'];?>"
                             data-year="<?php echo $trendingMovie['Year'];?>"
                             data-imdbID="<?php echo $trendingMovie['imdbID']; ?>">
                            <img class="image posterImage" src="<?php echo $trendingMovie['Poster'];?>"/>
                        </div>
                    </td>
                </tr>
            </table>
        <?php endforeach; ?>
    </div>
@endsection
