<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;
use Illuminate\View\View;

class SearchController extends BaseController
{
    private Client $client;
    private string $apiKeyUrlPart;
    private string $baseUrl = "https://www.omdbapi.com/?s=";
    private string $baseUrlDesc = "https://www.omdbapi.com/?t=";
    private string $baseUrlImdbID = "https://www.omdbapi.com/?i=";
    private string $fullPlot = "&plot=full";

    public function __construct()
    {
        $this->client = new Client();
        // TODO: Get this from the ENV file
        $apiKey = "fe080be1";
        $this->apiKeyUrlPart = "&apikey=$apiKey";
    }

    /**
     * @param string $userSearchTerm
     * @return string
     */
    private function buildApiUrl(string $userSearchTerm): string
    {
        return $this->baseUrl . $userSearchTerm . $this->apiKeyUrlPart;
    }

    /**
     * @param string $userSearchTerm
     * @param string $movieYear
     * @return string
     */
    private function buildApiUrlDesc(string $userSearchTerm, string $movieYear): string
    {
        $movieYearUrl = "&y=".$movieYear;
        return $this->baseUrlDesc . $userSearchTerm . $movieYearUrl . $this->apiKeyUrlPart;
    }

    /**
     * @param string $userSearchTerm
     * @param string $movieYear
     * @return string
     */
    private function buildApiUrlDescFull(string $userSearchTerm, string $movieYear): string
    {
        $movieYearUrl = "&y=".$movieYear;
        return $this->baseUrlDesc . $userSearchTerm . $movieYearUrl . $this->fullPlot . $this->apiKeyUrlPart;
    }

    /**
     * @param string $imdbID
     * @return string
     */
    private function buildApiUrlImdbID(string $imdbID): string
    {
        $movieID = $imdbID;
        return $this->baseUrlImdbID . $movieID . $this->apiKeyUrlPart;
    }

    /**
     * @param string $imdbID
     * @return string
     */
    private function buildApiUrlImdbIDFull(string $imdbID): string
    {
        $movieID = $imdbID;
        return $this->baseUrlImdbID . $movieID . $this->fullPlot . $this->apiKeyUrlPart;
    }

    /**
     * @return View
     */
    function searchResults(): View
    {
        $usrSearch = $_GET['movie_title'];
        $usrSearch = trim($usrSearch);
        $usrSearch = htmlentities($usrSearch);
        $finalUrl = $this->buildApiUrl($usrSearch);
        try {
            $res = $this->client->request('GET', $finalUrl, []);
            $resBody = $res->getBody()->getContents();
            $parsed = json_decode($resBody, true);
            if(!(str_contains($resBody, 'False')))
            {
                return view('layouts/searchResults', ['searchResults' => $parsed['Search']]);
            }
            else
            {
                $emptyResult['Search'][] = [
                  'Title' => "",
                  'Year' => "",
                  'Poster' => "",
                  'imdbID' => ""
                ];
                return view('layouts/searchResults', ['searchResults' => $emptyResult['Search']]);
            }
        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }
    }

    /**
     * @return array
     */
    function movieSearchDesc(): array
    {
        $movie_IMDBID = $_GET['i'];
        $finalUrl = $this->buildApiUrlImdbID($movie_IMDBID);
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
     */
    function movieSearchDescTitleYear(): array
    {
        $movie_name = $_GET['movieName'];
        $movie_year = $_GET['movieYear'];
        $finalUrl = $this->buildApiUrlDescFull($movie_name, $movie_year);
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
        $movie_title = $_GET['movieTitle'];
        $movie_year = $_GET['movieYear'];
        $finalUrl = $this->buildApiUrlDescFull($movie_title , $movie_year);
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
     * @return array
     * @throws GuzzleException
     */
    function getTrending(): array
    {
        $movieList2 = [
            'Inception',
            'Peaky blinders'
        ];

        $movieList = [
            'Mask',
            'Mean Girls',
            'Shrek',
            'Inception',
            'Lion King',
            'Pirates of the caribbean',
            'Peaky blinders'
        ];

        shuffle($movieList);

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
            foreach($parsed['Search'] as $movieResult)
            {
              if(isset($movieResult['Poster']) && !empty($movieResult['Poster']) && $movieResult['Poster'] != 'N/A')
              {
                  $validMovieList[] = $movieResult;
              }
            }
        }
        $trendingMovies['Search'][] = $validMovieList;
        return $trendingMovies;
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
}
