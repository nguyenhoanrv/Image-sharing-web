@extends('layouts.app')
@section('title')
    | {{ $category->name }}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center m-4">
                <h1>{{ $category->name }}</h1>

            </div>
        </div>
        <div class="row">
            @foreach ($category->albums as $album)
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <a href="{{ route('image-view', ['id' => $album->id]) }}">
                            <img src="{{ '/album/' . $album->image }}" class="card-img-top" alt="Card image cap"
                                height="300px" style="object-fit: cover">

                        </a>

                        <div class="card-body">
                            <h5 class="card-title">{{ $album->name }}</h5>
                            <p class="card-text">{{ $album->description }}</p>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <img src="/assets/images/small/img-3.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title that wraps to a new line</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                </div> --}}
            @endforeach
        </div>

    </div>
@endsection
