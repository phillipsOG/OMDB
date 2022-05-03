require('./bootstrap');

$(document).ready(function() {
    $("#searchImg.image").on("click", function(ev) {
        let images = document.getElementsByClassName('imageContainer');
        for(let i = 0; i < images.length; i++)
        {
            images[i].onclick = function (img) {
                const title = images[i].querySelectorAll('p')[0].dataset.title;
                const year = images[i].querySelectorAll('p')[0].dataset.year;
                console.log(title + ", Year: " + year);
                getTitleDesc(title, year);
            }
        }
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
})

$(document).ready(function() {
   $('#desc-cont').on("click", function(ev) {
      ev.stopPropagation();
   });
});

$(document).ready(function() {
    $('#description').on("click", function(ev) {
        $('#description').animate({width: 'toggle'});
        $('#description').hide();
        $('#test').show();
    });
});

$(document).ready(function() {
    $('#test').on("click", function(ev) {
        if(!($('#box-office.box-office').text().length > 1))
        {
            $('#test').hide();
            $('#description').animate({width: 'toggle'});
        }
    });
});

$(document).ready(function() {
    $('#m-poster').on("click", function (ev) {
        let movies = document.getElementsByClassName('description');
        let imdbID = movies[0].querySelectorAll('p')[0].dataset.imdbID;
        $.ajax({
            type: "GET",
            url: "/viewPoster",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {"i": imdbID},
            success: function(response) {
                window.location.href = "/viewPoster?i="+imdbID;
            }
        })
        ev.stopPropagation();
    });
});

$(document).ready(function() {
    $("#searchImg.image").on("dblclick", function(ev) {
        let movies = document.getElementsByClassName('description');
        let imdbID = movies[0].querySelectorAll('p')[0].dataset.imdbID;
        $.ajax({
            type: "GET",
            url: "/viewPoster",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {"i": imdbID},
            success: function(response) {
                window.location.href = "/viewPoster?i="+imdbID;
            }
        })
    });
});

function getTitleDesc(movie_title, movie_year)
{
    $.ajax({
       type: "GET",
       url: "/movieSearchDesc",
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       data: {"movieName": movie_title, "movieYear": movie_year},
       success: function(response) {
           $('#test').html(response['Movies']);
           let movies = document.getElementsByClassName('description');
           if(response['Poster'] != "N/A")
           {
               $('#m-poster').attr("src", response['Poster']);
           }
           else
           {
               $('#m-poster').attr("src", "https://i.imgur.com/jHsym5q.png");
           }
           movies[0].querySelectorAll('p')[0].dataset.imdbID = response['imdbID'];
           movies[0].querySelectorAll('p')[1].innerText = response['Title'];
           movies[0].querySelectorAll('p')[2].innerText = response['Genre'];
           movies[0].querySelectorAll('p')[3].innerText = "Rating " + response['imdbRating'];
           movies[0].querySelectorAll('p')[4].innerText = "Released " + response['Released'];
           movies[0].querySelectorAll('p')[5].innerText = "Director " + response['Director'];
           movies[0].querySelectorAll('p')[6].innerText = "Summary\n\n" + response['Plot'];
       }
    });
}


