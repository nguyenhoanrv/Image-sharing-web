@extends('layouts.app')

@section('content')
<div class="container-fluid" id="app">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="jumbotron jumbotron-fluid">
                  <div class="container">
                    <h1 class="display-4">Fluid jumbotron</h1>
                    <p class
                    ="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
                  <a class="btn btn-primary btn-lg" href="{{route('album.create')}}" role="button">Create New Album</a>
                  </div>
                </div>
                <album-index-component></album-index-component>
            </div>
        </div>
    </div>
</div>
@endsection
