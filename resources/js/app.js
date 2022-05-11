require('./bootstrap');

$(document).ready(function() {
    let searchImage = $("#searchImg.image");

    searchImage.on("click", function() {
        let images = document.getElementsByClassName('imageContainer');
        for(let i = 0; i < images.length; i++) {
            images[i].onclick = function () {
                const imdbID = images[i].querySelectorAll('p')[0].dataset.imdbid;
                getTitleDesc(imdbID);
            }
        }
        window.scrollTo({top: 0, behavior: 'smooth'});
    });

    $('#desc-cont').on("click", function(ev) {
        ev.stopPropagation();
    });

    $('#description').on("click", function() {
        //$('#description').animate({width: 'toggle'});
        $('#description').hide();
        $('#collapse-description').show();
    });

    $('#collapse-description').on("click", function() {
        if(!($('#box-office.box-office').text().length > 1)) {
            $('#collapse-description').hide();
            $('#description').show();
        }
    });

    if($('#searchImg.image').attr('src') === '')  {
        alert('true');
    }

    $('#m-poster').on("click", function (ev) {
        let movies = document.getElementsByClassName('description');
        let movie_title = movies[0].querySelectorAll('p')[0].innerText;
        let movie_year = movies[0].querySelectorAll('p')[4].innerText.replace('Released ', '');
        $.ajax({
            type: "GET",
            url: "/viewPoster",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {"movieTitle": movie_title, "movieYear":movie_year},
            success: function() {
                window.location.href = "/viewPoster?movieTitle="+movie_title+"&movieYear="+movie_year;
            }
        })
        ev.stopPropagation(); //stops highlighting on poster click
    });
});

function getTitleDesc(movie_imdbID) {
    $.ajax({
       type: "GET",
       url: "/movieSearchDesc",
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       data: {"i":movie_imdbID},
       success: function(response) {
           let movies = document.getElementById('#description');
           if(response['Poster'] !== "N/A")  {
               $('#m-poster').attr("src", response['Poster']);
           } else  {
               $('#m-poster').attr("src", "https://i.imgur.com/jHsym5q.png");
           }
           if (typeof movies !== "undefined") {
               $('#m-indent').attr('imdbid', response['imdbID']);
               $('#m-title').text(response['Title']);
               $('#m-genre-data').text(response['Genre']);
               $('#imdb-star').attr("src", "https://i.imgur.com/L9hNySh.png");
               $('#m-rating-data').html(response['imdbRating']);
               $('#m-year').html(response['Year']);
               $('#m-director-data').html(response['Director']);
               $('#m-summary-data').html(response['Plot']);
               $('#m-actors-data').html(response['Actors']);
           }
       }
    });
}
