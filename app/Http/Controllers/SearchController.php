<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;
use Illuminate\View\View;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class SearchController extends BaseController
{
    private Client $client;
    private string $apiKey;
    private string $baseUrl = "https://www.omdbapi.com/?s=";
    private string $baseUrlDesc = "https://www.omdbapi.com/?t=";
    private string $baseUrlImdbID = "https://www.omdbapi.com/?i=";
    private string $fullPlot = "&plot=full";

    public function __construct()
    {
        $this->client = new Client();
        // TODO: Get this from the ENV file
        $this->apiKey = 'fe080be1';
    }

    /**
     * @param string $userSearchTerm
     * @return string
     */
    private function buildApiUrl(string $userSearchTerm): string
    {
        $apiKey = "&apikey=$this->apiKey";
        return $this->baseUrl . $userSearchTerm . $apiKey;
    }

    /**
     * @param string $userSearchTerm
     * @param string $movieYear
     * @return string
     */
    private function buildApiUrlDesc(string $userSearchTerm, string $movieYear): string
    {
        $apiKey = "&apikey=$this->apiKey";
        $movieYearUrl = "&y=".$movieYear;
        return $this->baseUrlDesc . $userSearchTerm . $movieYearUrl . $apiKey;
    }

    /**
     * @param string $userSearchTerm
     * @param string $movieYear
     * @return string
     */
    private function buildApiUrlDescFull(string $userSearchTerm, string $movieYear): string
    {
        $apiKey = "&apikey=$this->apiKey";
        $movieYearUrl = "&y=".$movieYear;
        return $this->baseUrlDesc . $userSearchTerm . $movieYearUrl . $this->fullPlot . $apiKey;
    }

    /**
     * @param string $imdbID
     * @return string
     */
    private function buildApiUrlImdbID(string $imdbID): string
    {
        $apiKey = "&apikey=$this->apiKey";
        $movieID = $imdbID;
        return $this->baseUrlImdbID . $movieID . $this->fullPlot . $apiKey;
    }

    /**
     * @return View
     */
    function searchResults(): View
    {
        // TODO: Check isset
        $usrSearch = $_GET['movie_title'];
        $usrSearch = trim($usrSearch);
        $finalUrl = $this->buildApiUrl($usrSearch);
        try {
            $res = $this->client->request('GET', $finalUrl, []);
            $resBody = $res->getBody()->getContents();

            $parsed = json_decode($resBody, true);
        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }
        return view('layouts/searchResults', ['searchResults' => $parsed['Search']]);
    }

    /**
     * @return array
     */
    function movieSearchDesc(): array
    {
        $movie_title = $_GET['movieName'];
        $movie_year = $_GET['movieYear'];
        $finalUrl = $this->buildApiUrlDesc($movie_title, $movie_year);
        try {
            $res = $this->client->request('GET', $finalUrl, []);
            $resBody = $res->getBody()->getContents();
            $parsed = json_decode($resBody, true);
        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }
        return $parsed;
    }

    /**
     * @return view
     */
    function singlePosterView(): view
    {
        $imdbID = $_GET['i'];
        $finalUrl = $this->buildApiUrlImdbID($imdbID);
        try {
            $res = $this->client->request('GET', $finalUrl, []);
            $resBody = $res->getBody()->getContents();
            $parsed = json_decode($resBody, true);
        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }
        return view('pages/singlePosterView', ['movieDesc' => $parsed]);
    }
    /**
     * @return view
     */
    function singlePosterViewNoYear(): view
    {
        $movie_title = $_GET['movieName'];
        $finalUrl = $this->buildApiUrl($movie_title);
        try {
            $res = $this->client->request('GET', $finalUrl, []);
            $resBody = $res->getBody()->getContents();
            $parsed = json_decode($resBody, true);
        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }
        return view('test_views/singlePosterView2', ['movieDesc' => $parsed]);
    }

    /**
     * @return array
     */
    function raw(): array
    {
        $movie_title = $_GET['movieName'];
        $finalUrl = $this->buildApiUrl($movie_title);
        try {
            $res = $this->client->request('GET', $finalUrl, []);
            $resBody = $res->getBody()->getContents();
            $parsed = json_decode($resBody, true);
        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }
        return $parsed;
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    function getTrending(): array
    {
        $movieList = [
          'Mask',
          'Mean Girls'
        ];

        $trendingMovies = [
            'Search' => []
        ];
        $validMovieList = [
            'Search' => []
        ];
        foreach($movieList as $movieTitle)
        {
            $apiUrl = $this->buildApiUrl($movieTitle);
            $res = $this->client->request('GET', $apiUrl, []);
            $body = $res->getBody()->getContents();
            $parsed = json_decode($body, true);
            $trendingMovies['Search'][] = $parsed['Search'];
            foreach($parsed['Search'] as $movieResult)
            {
              if(isset($movieResult['Poster']) && !empty($movieResult['Poster']) && $movieResult['Poster'] != 'N/A')
              {
                  $validMovieList[] = $movieResult;
              }
            }
        }
        //$trendingMovies['Search'][] = $validMovieList;
        return $trendingMovies;
    }
}
