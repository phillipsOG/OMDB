<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function index(): View
    {
        $searchController = new SearchController();
        $parsed = $searchController->getTrending();
        return view('pages/home', ['trendingMovies' => $parsed]);
    }
}
