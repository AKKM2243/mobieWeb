<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;


class MovieController extends Controller
{
// ----------------------------FETCHING MOVIES DATA ----------------------------------------------------

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

        // Check if the request was successful
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody(), true);
        }

        // Handle the case when the API request is not successful
        return ['error' => 'Error: ' . $response->getStatusCode()];
    } catch (\Exception $e) {
        // Handle any exceptions that occur during the request
        return ['error' => 'Exception: ' . $e->getMessage()];
    }
}

// -----------------------------INDEX-------------------------------------------------------------------------------

public function index(Request $request)
{
    $perPage = 20;
    $currentPage = $request->input('page', 1);

    // Determine media type
    $mediaType = 'movie'; // Default to 'movie'
    if ($request->is('series')) {
        $mediaType = 'series';
    }

    // Fetch media data from the API for the current page based on the determined media type
    $mediaData = $mediaType === 'movie' ? $this->fetchMovieData('movie/upcoming', $currentPage) : $this->fetchSeriesData('tv/popular', $currentPage);
    // $movieData = $this->fetchData('movie/upcoming', $currentPage);

    if (isset($mediaData['results'])) {
        $media = collect($mediaData['results']);

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $media,
            $mediaData['total_results'],
            $perPage,
            $currentPage,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        // Determine headline based on media type
        $headline = $mediaType === 'movie' ? 'Movies' : 'Series';

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

    // Check if the request was successful
    if ($response->getStatusCode() == 200) {
        $movie = json_decode($response->getBody(), true);

        return view('movies.detail', ['movie' => $movie]);
    }

    // Handle the case when the API request is not successful
    return view('error', ['error' => 'Error: ' . $response->getStatusCode()]);
} catch (\Exception $e) {
    // Handle any exceptions that occur during the request
    return view('error', ['error' => 'Exception: ' . $e->getMessage()]);
}
}

// ----------------------------FETCHING SERIES DATA ------------------------------------------------------

    // public function fetchSeriesData($page)
    // {
    //     $apiUrl = "https://api.themoviedb.org/3/tv/popular?language=en-US&page=$page";

    //     $client = new Client();

    // try {
    //     $response = $client->get($apiUrl, [
    //         'headers' => [
    //             'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxOWRmNTg2ZmJmZWZkZDBlODYzNjYwYzA1NDM4ZTAyMCIsInN1YiI6IjY1NTc5YTVkYjU0MDAyMTRkM2NhMWYxZSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.huoy-q0lM3yusO8JXyjNFaBOqaG3vHB_gq4pCiPMEJU',
    //             'Accept' => 'application/json',
    //         ],
    //     ]);

    //     // Check if the request was successful
    //     if ($response->getStatusCode() == 200) {
    //         return json_decode($response->getBody(), true);
    //     }

    //     // Handle the case when the API request is not successful
    //     return ['error' => 'Error: ' . $response->getStatusCode()];
    // } catch (\Exception $e) {
    //     // Handle any exceptions that occur during the request
    //     return ['error' => 'Exception: ' . $e->getMessage()];
    // }
    // }

// -------------------------------FETCH UPCOMING MOVIES-------------------------------------------------------------------

public function home(Request $request)
{
    $perPage = 20;
    $currentPage = $request->input('page', 1);

    // Determine media type
    $mediaType = 'movie'; // Default to 'movie'
    if ($request->is('series')) {
        $mediaType = 'series';
    }

    // Fetch media data from the API for the current page based on the determined media type
    // $mediaData = $mediaType === 'movie' ? $this->fetchMovieData($currentPage) : $this->fetchSeriesData($currentPage);
    $mediaData = $mediaType === 'movie' ? $this->fetchMovieData('movie/upcoming', $currentPage) : $this->fetchSeriesData('tv/popular', $currentPage);


    if (isset($mediaData['results'])) {
        $media = collect($mediaData['results']);

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $media,
            $mediaData['total_results'],
            $perPage,
            $currentPage,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        // Determine headline based on media type
        $headline = $mediaType === 'movie' ? 'Movies' : 'Series';

        return view('home', compact('media', 'paginator', 'headline'));
    } else {
        return view('error', ['error' => 'Error: "results" key not found in API response']);
    }
}

}

