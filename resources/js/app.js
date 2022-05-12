require('./bootstrap');

$(document).ready(function() {

    let moviePoster = $("#searchImg.image");

    moviePoster.on("click", function() {
        let images = $('.imageContainer');
        for(let i = 0; i < images.length; i++) {
            images[i].onclick = function () {
                const imdbID = images[i].dataset.imdbid;
                getTitleDesc(imdbID);
            }
        }
        window.scrollTo({top: 0, behavior: 'smooth'});
    });

    $('#m-poster').on("click", function (ev) {
        let movieTitle = $('#m-title').text();
        let movieYear = $('#m-year').text();
        $.ajax({
            type: "GET",
            url: "/viewPoster",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {"movieTitle": movieTitle, "movieYear":movieYear},
            success: function() {
                window.location.href = "/viewPoster?movieTitle="+movieTitle+"&movieYear="+movieYear;
            }
        })
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

    $('#desc-cont').on("click", function(ev) {
        ev.stopPropagation();
    });
});

function getTitleDesc(movieIMDBID) {
    $.ajax({
       type: "GET",
       url: "/movieSearchDesc",
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       data: {"i":movieIMDBID},
       success: function(response) {
           let movies = $('#description');
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


