# Open Movie Database (OMDB)
<p>OMDB was made for searching movie titles for those who would want a quick summary of a movie or an expanded view with more detail i.e. extended movie summary with box office data.</p>

<h1>How do I use it?</h1>
<p>At the top of the header nav bar is a site-wide search box used to get movie data.</p>
<ol>
    <li>Simply type in the name of the movie you'd like information on.</li>
    <br>
        <ul><image src="https://i.imgur.com/KkMmV6H.png"></image></ul>
    <br>
    <li>A view with all the potential results that match the queried title will be returned.</li>
    <br>
        <ul><image src="https://i.imgur.com/LMb1wAl.png"></image></ul>
    <br>
    <li>Click on a movie poster to load up a brief description that is shown inside the description panel to the right.</li>
    <br>
        <ul><image src="https://i.imgur.com/DqznhtC.png"></image></ul>
    <br>
    <li>Click on the movie poster inside the description panel to load a single page view with expanded information and box office data.</li>
    <br>     
    <ul><image src="https://i.imgur.com/syRHuDq.png"></image></ul>
</ol>
<p>Sweet, you have successfully queried OMDB for movie data to view.</p>

<h1>How to Receive an API Key & Configure Env Variable</h1>
<h3>Signing Up</h3>
<p>Register a free account with a valid email at https://www.omdbapi.com/ to receive your API key.</p>

<h3>Configuring Env</h3>
<p>Navigate to the root folder of the application and rename the file '.env.example' to '.env'</p>
<li>add this line to the bottom of the .env file</li>
<li>OMDB_API_KEY=""</li>
<li>insert your API key in-between the quotations</li>
<br>
<p>You can now query the API for movies.</p>

<h1>Setting Up Docker /w Image</h1>
<p>Run:</p>
<ol>
    <li>npm install</li>
    <li>composer install</li>
<br>
or for Windows / Mac users,
<li>Composer install --ignore-platform-req=ext-fileinfo --ignore-platform-req=ext-fileinfo</li>
<br>
<li>php artisan key:generate</li>
<li>docker-compose up</li>
</ol>

<p>You should now be able to navigate to the website by connecting through localhost.</p>

<h3>Authors Note</h3>
<p>Developed on a monitor with a resolution of <b>2560x1440</b></p>
