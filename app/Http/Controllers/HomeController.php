<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SearchController;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function __construct()
    {

    }

    public function index(): View
    {
        $sC = new SearchController();
        $parsed = $sC->getTrending();
        return view('pages/home', ['trendingMovies' => $parsed]);
    }
}
