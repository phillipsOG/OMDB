<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Routing\Controller as BaseController;
use GuzzleHttp\Client;

class SearchController extends BaseController
{
    public function __construct()
    {
    }

    function movieSearch(): string
    {
        //http://www.omdbapi.com/?apikey=[fe080be1]&
        //OLD http://www.omdbapi.com/?i=tt3896198&apikey=fe080be1
        $url = "http://www.omdbapi.com/?s=";
        $apiKey = "&apikey=fe080be1";
        $usrSearch = $_POST['movieName'];
        $finalUrl = $url.$usrSearch.$apiKey;
        $data = ['key1' => 'value1', 'key2' => 'value2'];
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($finalUrl, false, $context);
        //var_dump($result);
        //return response()->json(['result' => "test response"]);

        //Guzzle
        $client = new Client();
        try
        {
            $res = $client->request('GET', $finalUrl, []);
            $statusCode = $res->getStatusCode();
            $resBody = $res->getBody();
            return response()->json(['result' => "$statusCode.$resBody"]);
        }
        catch (GuzzleException $e)
        {

        }
    }
}
