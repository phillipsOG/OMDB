<meta name="csrf-token" content="{{ csrf_token() }}" />
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<div>
    <body>
        <h1>The Open Movie Database Project</h1>
        <p>Open Movie DB is a website for searching movie titles across genres and categories.</p>
        <form id="movieForm" action="">
            Input: <input type="text" id="movie_title">
            <button type="submit" id="submit" class="btn btn-success">
                <i class="fa-trash"></i>Search
            </button>
            <br>
            <p id="test">Text</p>
        </form>
    </body>
</div>
