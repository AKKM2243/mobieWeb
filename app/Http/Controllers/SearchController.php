<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    private function fetchData($endpoint, $query)
{
    $apiUrl = "https://api.themoviedb.org/3/$endpoint?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc&with_keywords=$query";


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

    public function index(Request $request)
    {
        $query = $request->input('query');
        $perPage = 20;
        $currentPage = $request->input('page', 1);

        $endpoint = 'search/movie';

        if ($request->is('series')) {
            $endpoint = 'search/tv';
        }

        $mediaData = $this->fetchData($endpoint, $currentPage);

        if (isset($mediaData['results'])) {
            $media = collect($mediaData['results']);



        // Perform search logic here based on the $query
        // You can use your existing logic or implement new logic specific to search

        // For now, let's just return the query for testing
        // return view('search.index', ['query' => $query]);
        return view('search.index', compact('media'));
        } else {
            return view('error', ['error' => 'Error: "results" key not found in API response']);
        }
    }
}
