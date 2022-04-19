require('./bootstrap');

$(document).ready(function(){
    // api key
    $("#submit").on("click", function(ev) {
        let usrInput = $("#movie_title").val();
        $("#test").text(usrInput);
        console.log("You clicked submit, input: " + usrInput);
        getTitle(usrInput);
        ev.preventDefault();
    });
    //https://api.jquery.com/jquery.getjson/
    console.log("this is an edit test");
});

function getTitle(movie_title)
{
    $.ajax({
        type: "POST",
        url: "/movieSearch",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        data: {"movieName": movie_title},
        success: function (response) {
            console.log(response);
        }
    });
}
/*
User types in a movie, clicks search:
takes movie string and queries the API
- we get result
- display in console
 */
