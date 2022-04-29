<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Integer;

class SearchController extends BaseController
{
    private Client $client;
    private string $apiKey;
    private string $baseUrl = "https://www.omdbapi.com/?s=";
    private string $baseUrlDesc = "https://www.omdbapi.com/?t=";

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
     * @return View
     */
    function searchResults(): View
    {
        // TODO: Check isset
        $usrSearch = $_GET['movie_title'];

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
     * @return view
     */
    function movieSearchDesc(): view
    {
        $movie_title = $_GET['movieName'];
        $movie_year = $_GET['movieYear'];
        $finalUrl = $this->buildApiUrlDesc($movie_title, $movie_year);
        //echo $finalUrl;
        try {
            $res = $this->client->request('GET', $finalUrl, []);
            $resBody = $res->getBody()->getContents();
            $parsed = json_decode($resBody, true);
            $desc = [
                "Desc" => $parsed
            ];

           //return $desc;
        } catch (GuzzleException $e) {
            dd($e->getMessage());
        }
        //var_dump($parsed);
        $descriptionView = view('layouts/description', ['movieDesc' => $parsed]);
        $renderedDescView = $descriptionView->render();
        $results = [
            "results" => $renderedDescView
        ];
        response()->json($parsed)->send();
    }
}
