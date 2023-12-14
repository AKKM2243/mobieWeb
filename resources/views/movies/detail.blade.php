@extends("layouts.app")
@section("content")
    <div class="backdrop-section" style="background-image: url('https://image.tmdb.org/t/p/w440_and_h660_face{{ $movie ? $movie['backdrop_path'] : 'placeholder.jpg' }}');">
        <div class="blurred-backdrop">
            <div class="container">
                <div class="mt-4 mb-2 border-0 border-light-subtle">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="card-img-top img-fluid shadow-lg mb-3"  src="https://image.tmdb.org/t/p/w440_and_h660_face{{ $movie ? $movie['poster_path'] : 'placeholder.jpg' }}" alt="Movie Image">
                        </div>
                        <div class="col-md-10">
                            <span>
                                <h5 class="card-title text-light text-uppercase mb-2" id="fs-5">
                                    {{ $movie ? $movie['title'] : "no title" }}
                                </h5>
                            </span>
                            <span>
                                <h5 class="card-title text-light mb-3">
                                    <span class="rounded-5 px-2 py-1 bg-danger mx-1" id="fs-3">
                                        Action
                                    </span>
                                    <span class="rounded-5 px-2 py-1 bg-danger me-1" id="fs-3">
                                        Drama
                                    </span>
                                    <span class="rounded-5 px-2 py-1 bg-danger me-1" id="fs-3">
                                        Documentory
                                    </span>
                                </h5>
                                <div class="row mt-4">
                                    <div class="col-md-2">
                                        <h5 class="text-secondary">Type:</h5>
                                        <h5 class="text-secondary">Country:</h5>
                                        <h5 class="text-secondary">Director:</h5>
                                        <h5 class="text-secondary">Release:</h5>
                                        <h5 class="text-secondary">Production:</h5>
                                        <h5 class="text-secondary">Cast:</h5>
                                        <h5 class="text-secondary">Tags:</h5>
                                    </div>
                                    <div class="col-md-10">
                                        <h5 class="text-secondary">Movie</h5>
                                        <h5 class="text-secondary">United State</h5>
                                        <h5 class="text-secondary">Pierre Morel</h5>
                                        <h5 class="text-secondary">{{ \Illuminate\Support\Str::limit("{$movie['release_date']}", 15, $end='') }}</h5>
                                        <h5 class="text-secondary">AGC Studios, Endurance Media, Sentient Entertainment</h5>
                                        <h5 class="text-secondary">Alice Eve, John Cena, Alison Brie</h5>
                                        <h5 class="text-secondary">freelance free online, freelance movie download, freelance free stream, freelance hd download, free watch freelance, freelance online watch</h5>
                                    </div>
                                </div>
                            </span>
                            <p class="tc-1 text-uppercase" id="fs-4">
                                {{ $movie ? $movie['overview'] : "overview not avaliable"}}
                            </p>
                        </div>
                    </div>
                    <div class="fixed-bottom mb-5 mr-5">
                        <div class="row justify-content-end">
                            <div class="col-md-2 ps-5">
                                <button class="custom-btn btn-4 ms-5">Trailer</button>
                            </div>
                            <div class="col-md-2">
                                <button class="custom-btn btn-11">Download</button>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card-subtitle mb-2 text-muted small">
                        {{ $movie['release_date']}}
                    </div>
                    <a class="btn btn-warning" href="{{ url("/movies/download/$movie->id") }}">
                        Download
                    </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
 @endsection
