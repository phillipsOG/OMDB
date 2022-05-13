@section('title', 'Description')
@section('description')
    <div class="collapse-description" id="collapse-description"></div>
    <div class="description" id="description">
        <img class="m-poster" id="m-poster" src="https://i.imgur.com/jHsym5q.png" alt="movie poster"/>
        <div class="description-content" id="description-content">
            <p id="m-title">Movie Title</p>
            <p id="m-genre-data">Movie Genre</p>
            <table>
                <tr>
                    <th>IMDB Rating</th>
                    <th>Year</th>
                </tr>
                <tr>
                    <td id="m-rating"><image id="imdb-star" src="https://i.imgur.com/L9hNySh.png"></image>
                            <p id="m-rating-data"> Rating</p></td>
                    <td id="m-year">Year</td>
                </tr>
            </table>
            <p id="m-director-title">Director</p>
            <p id="m-director-data"></p>
            <p id="m-summary-title">Summary</p>
            <p id="m-summary-data"></p>
            <p id="m-actors-title">Lead actors</p>
            <p id="m-actors-data"></p>
        </div>
    </div>
@endsection
