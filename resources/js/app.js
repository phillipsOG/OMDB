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
        for(let i = 0; i < images.length; i++)
        {
            images[i].onclick = function (img) {
                const title = images[i].querySelectorAll('p')[0].innerText;
                const year = images[i].querySelectorAll('p')[1].innerText;
                //alert("Image Index: " + i + ", Movie Title: " + title + ", Movie Year: " + year);
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
           //let movieResults = response['Plot'];
           $('#movieDesc').html(response['Plot']);
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
            let movieResults = response['results'];
            $('#test2').html(movieResults);
        }
    });
}
