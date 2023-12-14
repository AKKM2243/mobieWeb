<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class movieController extends Controller
{
    public function fetchMovieData()
    {
        $apiUrl = 'https://api.themoviedb.org/3/movie/upcoming?language=en-US&page=1';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxOWRmNTg2ZmJmZWZkZDBlODYzNjYwYzA1NDM4ZTAyMCIsInN1YiI6IjY1NTc5YTVkYjU0MDAyMTRkM2NhMWYxZSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.huoy-q0lM3yusO8JXyjNFaBOqaG3vHB_gq4pCiPMEJU',
            'Accept' => 'application/json',
        ])->get($apiUrl);

        // Check if the request was successful
        if ($response->successful()) {
            // Process $response (JSON data) here
            $data = $response->json();

            // Return the processed data
            return $data;
        }

        // Handle the case when the API request is not successful
        return ['error' => 'Error: ' . $response->status()];
    }

    public function fetchSeriesData()
    {
        $apiUrl = 'https://api.themoviedb.org/3/tv/airing_today?language=en-US&page=1';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxOWRmNTg2ZmJmZWZkZDBlODYzNjYwYzA1NDM4ZTAyMCIsInN1YiI6IjY1NTc5YTVkYjU0MDAyMTRkM2NhMWYxZSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.huoy-q0lM3yusO8JXyjNFaBOqaG3vHB_gq4pCiPMEJU',
            'Accept' => 'application/json',
        ])->get($apiUrl);

        // Check if the request was successful
        if ($response->successful()) {
            // Process $response (JSON data) here
            $data = $response->json();

            // Return the processed data
            return $data;
        }

        // Handle the case when the API request is not successful
        return ['error' => 'Error: ' . $response->status()];
    }
}
