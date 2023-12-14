<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;


class MovieController extends Controller
{
// ----------------------------FETCHING DATA ----------------------------------------------------

private function fetchData($endpoint, $page)
{
    $apiUrl = "https://api.themoviedb.org/3/$endpoint?language=en-US&page=$page";

    $client = new Client();

    try {
        $response = $client->get($apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxOWRmNTg2ZmJmZWZkZDBlODYzNjYwYzA1NDM4ZTAyMCIsInN1YiI6IjY1NTc5YTVkYjU0MDAyMTRkM2NhMWYxZSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.huoy-q0lM3yusO8JXyjNFaBOqaG3vHB_gq4pCiPMEJU',
                'Accept' => 'application/json',
            ],
        ]);

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody(), true);
        }

        return ['error' => 'Error: ' . $response->getStatusCode()];
    } catch (\Exception $e) {
        return ['error' => 'Exception: ' . $e->getMessage()];
    }
}

// -----------------------------INDEX-------------------------------------------------------------------------------

public function index(Request $request)
{
    $perPage = 20;
    $currentPage = $request->input('page', 1);

    if ($request->is('topseries')) {
        $mediaData = $this->fetchData('tv/popular', $currentPage);
    } elseif  ($request->is('atseries')) {
        $mediaData = $this->fetchData('tv/airing_today', $currentPage);
    } elseif  ($request->is('popseries')) {
        $mediaData = $this->fetchData('tv/popular', $currentPage);
    } elseif ($request->is('upmovies')) {
        $mediaData = $this->fetchData('movie/upcoming', $currentPage);
    } elseif ($request->is('popmovies')) {
        $mediaData = $this->fetchData('movie/popular', $currentPage);
    } elseif ($request->is('topmovies')) {
        $mediaData = $this->fetchData('movie/top_rated', $currentPage);
    } elseif ($request->is('movies')) {
        $mediaData = $this->fetchData('movie/popular', $currentPage);
    }

    if (isset($mediaData['results'])) {
        $media = collect($mediaData['results']);

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $media,
            $mediaData['total_results'],
            $perPage,
            $currentPage,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        // $headline = '';

        if ($request->is('atseries')) {
            $headline = 'Airing Today Series';
        } elseif ($request->is('topseries')) {
            $headline = 'Top Rated Series';
        } elseif ($request->is('popseries')) {
            $headline = 'Popular Series';
        } elseif ($request->is('upmovies')) {
            $headline = 'Upcoming Movies';
        } elseif ($request->is('popmovies')) {
            $headline = 'Popular Movies';
        } elseif ($request->is('topmovies')) {
            $headline = 'Top Rated Movies';
        } elseif ($request->is('movies')) {
            $headline = 'Latest Movies';  // Default for 'movies'
        }
        // $headline = $mediaType === 'movie' ? 'Latest Movies' : 'Latest Series';

        return view('movies.index', compact('media', 'paginator', 'headline'));
    } else {
        return view('error', ['error' => 'Error: "results" key not found in API response']);
    }
}

// ----------------------------DETAIL--------------------------------------------------------------------------------

public function detail($id) {
    $apiUrl = "https://api.themoviedb.org/3/movie/$id?language=en-US";

$client = new Client();

try {
    $response = $client->get($apiUrl, [
        'headers' => [
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxOWRmNTg2ZmJmZWZkZDBlODYzNjYwYzA1NDM4ZTAyMCIsInN1YiI6IjY1NTc5YTVkYjU0MDAyMTRkM2NhMWYxZSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.huoy-q0lM3yusO8JXyjNFaBOqaG3vHB_gq4pCiPMEJU',
            'Accept' => 'application/json',
        ],
    ]);

    if ($response->getStatusCode() == 200) {
        $movie = json_decode($response->getBody(), true);

        return view('movies.detail', ['movie' => $movie]);
    }

    return view('error', ['error' => 'Error: ' . $response->getStatusCode()]);
} catch (\Exception $e) {
    return view('error', ['error' => 'Exception: ' . $e->getMessage()]);
}
}


// -------------------------------FETCHING HOME-------------------------------------------------------------------

public function home(Request $request)
{
    $perPage = 20;
    $currentPage = $request->input('page', 1);

    $upmovieData = $this->fetchData('movie/upcoming', $currentPage);
    $popmovieData = $this->fetchData('movie/popular', $currentPage);
    $topmovieData = $this->fetchData('movie/top_rated', $currentPage);
    $topseriesData = $this->fetchData('tv/top_rated', $currentPage);
    $atseriesData = $this->fetchData('tv/airing_today', $currentPage);
    $popseriesData = $this->fetchData('tv/popular', $currentPage);

    // Check if both requests were successful
    if (isset($upmovieData['results']) && ($popmovieData['results']) && ($topmovieData['results'])  && isset($atseriesData['results']) && isset($popseriesData['results']) && isset($topseriesData['results'])) {
        $upmovies = collect($upmovieData['results']);
        $popmovies = collect($popmovieData['results']);
        $topmovies = collect($topmovieData['results']);
        $topseries = collect($topseriesData['results']);
        $atseries = collect($atseriesData['results']);
        $popseries = collect($popseriesData['results']);

        $upmoviePaginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $upmovies,
            $upmovieData['total_results'],
            $perPage,
            $currentPage,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        $popmoviePaginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $popmovies,
            $popmovieData['total_results'],
            $perPage,
            $currentPage,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        $topmoviePaginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $topmovies,
            $topmovieData['total_results'],
            $perPage,
            $currentPage,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );
        $atseriesPaginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $atseries,
            $atseriesData['total_results'],
            $perPage,
            $currentPage,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );
        $topseriesPaginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $topseries,
            $topseriesData['total_results'],
            $perPage,
            $currentPage,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        $popseriesPaginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $popseries,
            $popseriesData['total_results'],
            $perPage,
            $currentPage,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );


        return view('home', compact('upmovies','popmovies', 'topmovies', 'atseries', 'topseries', 'popseries'));
    } else {
        return view('error', ['error' => 'Error: "results" key not found in API response']);
    }
}

}

