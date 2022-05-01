require('./bootstrap');

$(document).ready(function(){
    $("#movieForm").on("submit", function(ev) {
        let usrInput = $("#movie_title").val();
        $("#test").text(usrInput);
        console.log("You clicked submit, input: " + usrInput);
        getTitle(usrInput);
    });
    //https://api.jquery.com/jquery.getjson/
    console.log("this is an edit test");
});

$(document).ready(function() {
    $("#searchImg.image").on("click", function(ev) {
        let images = document.getElementsByClassName('imageContainer');
        let movies = document.querySelector('#movieTitle');
        for(let i = 0; i < images.length; i++)
        {
            images[i].onclick = function (img) {
                const title = images[i].querySelectorAll('p')[0].dataset.title;
                const year = images[i].querySelectorAll('p')[0].dataset.year;
                getTitleDesc(title, year);
            }
        }
    });
})

function getTitleDesc(movie_title, movie_year)
{
    $.ajax({
       type: "GET",
       url: "/movieSearchDesc",
       headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       data: {"movieName": movie_title, "movieYear": movie_year},
       success: function(response) {
           console.log(response);
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

           movies[0].querySelectorAll('p')[0].innerText = response['Title'];
           movies[0].querySelectorAll('p')[1].innerText = response['Genre'];
           movies[0].querySelectorAll('p')[2].innerText = "Rating " + response['imdbRating'];
           movies[0].querySelectorAll('p')[3].innerText = "Released " + response['Released'];
           movies[0].querySelectorAll('p')[4].innerText = "Director " + response['Director'];
           movies[0].querySelectorAll('p')[5].innerText = "Summary\n\n" + response['Plot'];
       }
    });
}

function getTitle(movie_title)
{
    $.ajax({
        type: "GET",
        url: "/movieSearch",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {"movieName": movie_title},
        success: function (response) {
            //let movieResults = response['results'];
            //$('#test2').html(movieResults);
        }
    });
}
