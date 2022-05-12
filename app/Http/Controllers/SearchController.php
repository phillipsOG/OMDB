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
        $apiKey = env("OMDB_API_KEY");
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
     * @return View
     */
    function searchResults(): View
    {
        $usrSearch = $_GET['movieTitle'];
        $usrSearch = trim($usrSearch);
        $usrSearch = htmlentities($usrSearch);
        $finalUrl = $this->buildApiUrl($usrSearch);
        try {
            $res = $this->client->request('GET', $finalUrl, []);
            $resBody = $res->getBody()->getContents();
            $parsed = json_decode($resBody, true);

            if(!(str_contains($resBody, 'False')))
            {
                foreach($parsed['Search'] as $movie)
                {
                    if($movie['Poster'] == "N/A")
                    {
                        $movie['Poster'] = "https://i.imgur.com/jHsym5q.png";
                    }
                }

                return view('layouts/searchResults', ['searchResults' => $parsed['Search']]);
            }
            else
            {
                $emptyResult['Search'][] = [
                  'Title' => "",
                  'Year' => "",
                  'Poster' => "https://i.imgur.com/jHsym5q.png",
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
        $movieIMDBID = $_GET['i'];
        $finalUrl = $this->buildApiUrlImdbID($movieIMDBID);
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
        $movieTitle = $_GET['movieTitle'];
        $movieYear = $_GET['movieYear'];
        $finalUrl = $this->buildApiUrlDescFull($movieTitle , $movieYear);
        try {
            $res = $this->client->request('GET', $finalUrl, []);
            $resBody = $res->getBody()->getContents();
            $parsed = json_decode($resBody, true);

            $movieData = [
                'title' => $parsed['Title'] ?? 'N/A',
                'year' => $parsed['Year'] ?? 'N/A',
                'posterUrl' => $parsed['Poster'] ?? 'N/A',
                'genre' => $parsed['Genre'] ?? 'N/A',
                'rating' => $parsed['imdbRating'] ?? 'N/A',
                'released' => $parsed['Released'] ?? 'N/A',
                'boxOffice' => $parsed['BoxOffice'] ?? 'N/A',
                'director' => $parsed['Director'] ?? 'N/A',
                'summary' => $parsed['Plot'] ?? 'N/A',
                'actors' => $parsed['Actors'] ?? 'N/A'
            ];

        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }
        return view('pages/singlePosterView', ['movieDesc' => $parsed, 'movieData' => $movieData]);
    }

    /**
     * @return array
     * @throws GuzzleException
     */
    function getTrending(): array
    {
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

        $validMovieList = [];

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

        return $validMovieList;
    }
}
