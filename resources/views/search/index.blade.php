@extends("layouts.app")


@section('content')
    <div class="container">
        <a class="nav-link text-white" href="{{ route('ssearch.index') }}">Series</a> --}}
        <div class="row">
            @foreach($media as $movie)
                <div class="col mb-4" style="width: 20%;"> {{-- Set the width to 20% for 5 columns --}}
                    <div class="card rounded bg-dark text-white border-secondary">
                        <a href="{{ url("/allmovies/detail/{$movie['id']}") }}">
                            <img id="myImage" class="card-img-top img-fluid" src="https://image.tmdb.org/t/p/w440_and_h660_face{{ $movie ? $movie['poster_path'] : 'placeholder.jpg' }}" onerror="this.src='{{ asset('images/DFI.jpg') }}'" alt="movie poster not exit">
                        </a>
                        <div class="card-body">
                            <h5 class="card-text">
                                {{ empty($movie['title']) ? \Illuminate\Support\Str::limit($movie['name'], 25, $end='...') : \Illuminate\Support\Str::limit($movie['title'], 25, $end='...') }}


                            </h5>
                            <h5 class="card-title">
                                ({{ empty($movie['release_date']) ? \Illuminate\Support\Str::limit($movie['first_air_date'], 4, $end='') : \Illuminate\Support\Str::limit($movie['release_date'], 4, $end='') }})
                            </h5>
                        </div>
                    </div>
                </div>
                @if($loop->iteration % 5 == 0)
                    </div><div class="row">
                @endif
            @endforeach
        </div>
    </div>
@endsection

