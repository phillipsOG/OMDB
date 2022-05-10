<?php
/**
 * @var array $movieDesc
 */
?>
@section('title', 'Description')
@section('description')
    <div class="collapse-description" id="collapse-description"></div>
    <div class="description" id="description">
        <img class="m-poster" id="m-poster" src="
        <?php if(isset($movieDesc['Poster']))
        {
            if($movieDesc['Poster'] != "N/A")
            {
                echo $movieDesc['Poster'];
            }
            else {
                echo "https://i.imgur.com/jHsym5q.png";
            }
        }
        ?>"/>
        <p id="m-imbdID" data-imdbID="<?php
        if(isset($movieDesc['imdbID']))
        {
            echo $movieDesc['imdbID'];
        }?>">
        </p>
        <div class="description-contents" id="desc-cont">
        <p id="m-title"><?php
            if(isset($movieDesc['Title']))
            {
                echo $movieDesc['Title'];
            } else {
                echo "Movie Title";
            }
            ?>
        </p>
        <p id="m-genre"><?php
            if(isset($movieDesc['Genre']))
            {
                echo $movieDesc['Genre'];
            } else {
                echo "Movie Genre";
            }
            ?></p>
        <table>
            <tr>
                <th>Year</th>
                <th>IMDB Rating</th>
            </tr>
            <tr>
                <td id="m-year"><?php
                    if(isset($movieDesc['Year']))
                    {
                        echo "Released " . $movieDesc['Year'];
                    } else {
                        echo "Movie Year ";
                    }
                    ?>
                </td>
                <td id="m-rating"><?php
                    if(isset($movieDesc['imdbRating']))
                    {
                        echo "Rating " . $movieDesc['imdbRating'];
                    } else {
                        echo "Movie Rating";
                    }
                    ?>
                </td>
            </tr>
        </table>
        <p id="m-director"><?php
            if(isset($movieDesc['Director']))
            {
                echo "Director " . $movieDesc['Director'];
            } else {
                echo "Movie Director";
            }
            ?>
        </p>
        <p id="m-summary"><?php
            if(isset($movieDesc['Plot']))
            {
                ?><p id="m-summary-data">Summary<br><br> <?php echo $movieDesc['Plot'];?></p><?php
            } else {
                echo "Movie Summary";
            }
            ?>
        </p>
        <p id="m-actors"><?php
            if(isset($movieDesc['Actors']))
            {
                echo "Summary<br><br>" . $movieDesc['Actors'];
            } else {
                echo "Lead actors";
            }
            ?>
        </p>
        </div>
    </div>
@endsection
