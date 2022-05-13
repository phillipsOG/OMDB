require('./bootstrap');

$(document).ready(function() {

    $(".posterImage").on("click", function() {
        let imdbid = $(this).parent('.imageContainer').data('imdbid');

        if (typeof imdbid !== 'undefined' && imdbid !== '') {
            getTitleDesc(imdbid);
        }

        window.scrollTo({top: 0, behavior: 'smooth'});
    });

    $('#m-poster').on("click", function (ev) {
        let movieTitle = $('#m-title').text();
        let movieYear = $('#m-year').text();

        if(movieTitle !== "Movie Title"  && movieYear !== "Year" ) {
            $.ajax({
                type: "GET",
                url: "/viewPoster",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {"movieTitle": movieTitle, "movieYear":movieYear},
                success: function() {
                    window.location.href = "/viewPoster?movieTitle="+movieTitle+"&movieYear="+movieYear;
                }
            })
        }
        ev.stopPropagation();
    });

    $('#description').on("click", function(ev) {
        $('#description').attr("user-select: none");
        $('#description').animate({width: 'toggle'});
        $('#collapse-description').animate({width: 'toggle'});
    });

    $('#collapse-description').on("click", function() {
        if (!($('#box-office.box-office').text().length > 1)) {
            $('#collapse-description').animate({width: 'toggle'});
            $('#description').animate({width: 'toggle'});
        }
    });

    $('#description-content').on("click", function(ev) {
        ev.stopPropagation();
    });
});

function getTitleDesc(movieIMDBID) {
    $.ajax({
       type: "GET",
       url: "/movieSearchDesc",
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       data: {"i": movieIMDBID},
       success: function(response) {
           let movies = $('#description');

           $('#m-poster').attr(
               "src",
               response['Poster'] !== "N/A" ? response['Poster'] : "https://i.imgur.com/jHsym5q.png"
           );

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
