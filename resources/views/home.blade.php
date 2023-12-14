@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="d-flex justify-content-between">
                <h5 class="text-light">
                    Latest Movies
                </h5>
                <a href="{{ route('movies.index') }}" id="link-sty" class="text-light">
                    <span class="material-icons-outlined">more</span>
                </a>
            </div>
            <div >
                @php $count = 0 @endphp
            @foreach($popmovies as $movie)
                @if($count < 3)
                    <div class="row mb-2">
                        <div class="col-md-3 py-2">
                            <a href="{{ url("/allmovies/detail/{$movie['id']}") }}">
                                <img id="myImage" class="card-img-top img-fluid" src="https://image.tmdb.org/t/p/w440_and_h660_face{{ $movie ? $movie['poster_path'] : 'placeholder.jpg' }}" onerror="this.src='{{ asset('images/DFI.jpg') }}'" alt="movie poster not exit">
                            </a>
                        </div>
                        <div class="col-md-8 d-flex align-content-center flex-wrap">
                            <div>
                                <h5 class="text-light text-uppercase mt-2">
                                    {{ \Illuminate\Support\Str::limit("{$movie['title']}", 100, $end='...') }}
                                </h5>
                                <h5 class="h6 text-secondary text-uppercase">
                                    ({{ \Illuminate\Support\Str::limit("{$movie['release_date']}", 4, $end='') }})
                                </h5>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-content-center flex-wrap">
                            <a href="{{ url("/allmovies/detail/{$movie['id']}") }}" id="link-sty" class="text-light">
                                <span class="material-icons-outlined text-secondary">double_arrow</span>
                            </a>
                        </div>
                    </div>
                @php $count++ @endphp
                    @else
                        @break
                    @endif
            @endforeach
            </div>
        </div>
        <div class="col-md-8">
            <div class="video-container">

                <iframe src="https://www.youtube.com/embed/EvVk0sA8iYo"  allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <hr class="text-light">
    {{-- ---------------------------------------------UP COMING MOVIES------------------------------------------------------------ --}}
    <div class="container row text-light">
        <div class="col-md-4">
            <div class="upcoming position-relative">
                <div class="position-absolute top-50 start-50 translate-middle">
                    <h1 id="upcoming">
                        Upcoming <span class="text-danger">Movies</span>
                    </h1>
                    <p>
                        On the big screen and at home.
                    </p>
                    <a href="{{ route('upmovies.index') }}" class="btn btn-dark text-light border border-secondary">See More</a>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="scroll-tab top-50 start-50 translate-middle">
                <div class="scroll-indicator"></div>
                <div class="d-flex flex-nowrap overflow-auto">
                    @foreach ($upmovies as $movie)
                        <div class="me-2">
                            <div class="card rounded bg-dark text-white border-secondary" id="movie-tab">
                                <a href="{{ url("/allmovies/detail/{$movie['id']}") }}">
                                    <img id="myImage" class="card-img-top img-fluid" src="https://image.tmdb.org/t/p/w440_and_h660_face{{ $movie ? $movie['poster_path'] : 'placeholder.jpg' }}" onerror="this.src='{{ asset('images/DFI.jpg') }}'" alt="movie poster not exit">
                                </a>
                                <h5 class="card-text pt-2 px-2">
                                    {{ \Illuminate\Support\Str::limit("{$movie['title']}", 14, $end='...') }}
                                </h5>
                                <h5 class="card-title text-secondary px-2">
                                    ({{ \Illuminate\Support\Str::limit("{$movie['release_date']}", 4, $end='') }})
                                </h5>
                                <p class="text-secondary overflow-hidden px-2" style="max-height: 100px; overflow: hidden; text-overflow: ellipsis; white-space: normal;">
                                    {{ \Illuminate\Support\Str::limit("{$movie['overview']}", 170, $end='....') }}
                                    {{-- {{ \ $movie['overview']}} --}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <hr class="text-light">
    {{-- ---------------------------------------------Top Rated MOVIES------------------------------------------------------------ --}}
    <div class="container row text-light">
        <div class="col-md-4">
            <div class="upcoming position-relative">
                <div class="position-absolute top-50 start-50 translate-middle">
                    <h1 id="upcoming">
                        Top&nbsp;Rated <span class="text-danger">Movies</span>
                    </h1>
                    <p>
                        On the big screen and at home.
                    </p>
                    <a href="{{ route('topmovies.index') }}" class="btn btn-dark text-light border border-secondary">See More</a>

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="scroll-tab top-50 start-50 translate-middle">
                <div class="scroll-indicator"></div>
                <div class="d-flex flex-nowrap overflow-auto">
                    @foreach ($topmovies as $movie)
                        <div class="me-2">
                            <div class="card rounded bg-dark text-white border-secondary" id="movie-tab">
                                <a href="{{ url("/allmovies/detail/{$movie['id']}") }}">
                                    <img id="myImage" class="card-img-top img-fluid" src="https://image.tmdb.org/t/p/w440_and_h660_face{{ $movie ? $movie['poster_path'] : 'placeholder.jpg' }}" onerror="this.src='{{ asset('images/DFI.jpg') }}'" alt="movie poster not exit">
                                </a>
                                <h5 class="card-text pt-2 px-2">
                                    {{ \Illuminate\Support\Str::limit("{$movie['title']}", 14, $end='...') }}
                                </h5>
                                <h5 class="card-title text-secondary px-2">
                                    ({{ \Illuminate\Support\Str::limit("{$movie['release_date']}", 4, $end='') }})
                                </h5>
                                <p class="text-secondary overflow-hidden px-2" style="max-height: 100px; overflow: hidden; text-overflow: ellipsis; white-space: normal;">
                                    {{ \Illuminate\Support\Str::limit("{$movie['overview']}", 170, $end='....') }}
                                    {{-- {{ \ $movie['overview']}} --}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <hr class="text-light">
    {{-- -------------------------------------------------UP COMING SERIES-------------------------------------------------------- --}}
    <div class="container row text-light">
        <div class="col-md-8">
            <div class="scroll-tab top-50 start-50 translate-middle">
                <div class="scroll-indicator"></div>
                <div class="d-flex flex-nowrap overflow-auto">
                    @foreach ($atseries as $movie)
                        <div class="me-2">
                            <div class="card rounded bg-dark text-white border-secondary" id="movie-tab">
                                <a href="{{ url("/allmovies/detail/{$movie['id']}") }}">
                                    <img id="myImage" class="card-img-top img-fluid" src="https://image.tmdb.org/t/p/w440_and_h660_face{{ $movie ? $movie['poster_path'] : 'placeholder.jpg' }}" onerror="this.src='{{ asset('images/DFI.jpg') }}'" alt="movie poster not exit">
                                </a>
                                <h5 class="card-text pt-2 px-2">
                                    {{ \Illuminate\Support\Str::limit("{$movie['name']}", 14, $end='...') }}
                                </h5>
                                <h5 class="card-title text-secondary px-2">
                                    ({{ \Illuminate\Support\Str::limit("{$movie['first_air_date']}", 4, $end='') }})
                                </h5>
                                <p class="text-secondary overflow-hidden px-2" style="max-height: 100px; overflow: hidden; text-overflow: ellipsis; white-space: normal;">
                                    {{$movie['overview']}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="upcoming position-relative">
                <div class="ps-4 position-absolute top-50 start-50 translate-middle">
                    <h1 id="upcoming">
                       Today&nbsp;Airing <span class="text-danger">Series</span>
                    </h1>
                    <p>
                        Just at home.
                    </p>
                    <h2>
                        See All?
                    </h2>
                    <a class="btn btn-dark text-light border border-secondary" href="{{ route('movies.atseries') }}">Here it's</a>
                </div>
            </div>
        </div>
    </div>
    <hr class="text-light">
    {{-- -------------------------------------------------Top Rated SERIES-------------------------------------------------------- --}}
    <div class="container row text-light">
        <div class="col-md-8">
            <div class="scroll-tab top-50 start-50 translate-middle">
                <div class="scroll-indicator"></div>
                <div class="d-flex flex-nowrap overflow-auto">
                    @foreach ($topseries as $movie)
                        <div class="me-2">
                            <div class="card rounded bg-dark text-white border-secondary" id="movie-tab">
                                <a href="{{ url("/allmovies/detail/{$movie['id']}") }}">
                                    <img id="myImage" class="card-img-top img-fluid" src="https://image.tmdb.org/t/p/w440_and_h660_face{{ $movie ? $movie['poster_path'] : 'placeholder.jpg' }}" onerror="this.src='{{ asset('images/DFI.jpg') }}'" alt="movie poster not exit">
                                </a>
                                <h5 class="card-text pt-2 px-2">
                                    {{ \Illuminate\Support\Str::limit("{$movie['name']}", 14, $end='...') }}
                                </h5>
                                <h5 class="card-title text-secondary px-2">
                                    ({{ \Illuminate\Support\Str::limit("{$movie['first_air_date']}", 4, $end='') }})
                                </h5>
                                <p class="text-secondary overflow-hidden px-2" style="max-height: 100px; overflow: hidden; text-overflow: ellipsis; white-space: normal;">
                                    {{$movie['overview']}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="upcoming position-relative">
                <div class="ps-4 position-absolute top-50 start-50 translate-middle">
                    <h1 id="upcoming">
                       Top&nbsp;Rating <span class="text-danger">Series</span>
                    </h1>
                    <p>
                        Just at home.
                    </p>
                    <h2>
                        See All?
                    </h2>
                    <a class="btn btn-dark text-light border border-secondary" href="{{ route('movies.topseries') }}">Here it's</a>
                </div>
            </div>
        </div>
    </div>
    <hr class="text-light">
    {{-- --------------------------------------------------------------------------------------------------------- --}}
    <div class="containers">
        <div class="row">
            <div class="col-md-12 text-center mt-5">
                <button class="btn btn-primary" data-toggle="modal" data-target="#videoModal">
                    Open Video
                </button>
            </div>
        </div>
    </div>

    <!-- Video Modal -->
    <div class="modal fade absolute-container" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="absolute-element" role="document">
            <div class="">
                <iframe width="1050" height="590" src="https://www.youtube.com/embed/0VcC-5zqOWM" frameborder="3" allowfullscreen></iframe>
            </div>
            {{-- <iframe width="1036" height="583" src="https://www.youtube.com/embed/0VcC-5zqOWM" title="Suicide Squad: Kill the Justice League - OfficialJustice League Trailer - “No More Heroes” | DC" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe> --}}
        </div>
    </div>
</div>
@endsection
