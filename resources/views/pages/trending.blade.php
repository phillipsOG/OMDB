<?php
/**
 * @var array $trendingMovies
 */
?>

@section('trending')
        <?php foreach($trendingMovies as $key => $trendingMovie): ?>
        <table class="trending-table">
            <tr>
                <td class="trending-table-td">
                    <div class="imageContainer" data-title="<?php echo $trendingMovie['Title'];?>"
                         data-year="<?php echo $trendingMovie['Year'];?>"
                         data-imdbID="<?php echo $trendingMovie['imdbID']; ?>">
                        <img class="image" id="searchImg" src="
                        <?php echo $trendingMovie['Poster'];?>"/>
                    </div>
                </td>
            </tr>
        </table>
        <?php endforeach; ?>
@endsection
