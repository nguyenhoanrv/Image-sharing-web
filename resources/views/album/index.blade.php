@extends('layouts.app')
@section('title', '| Dashboard')
@section('content')
<div class="card">
  <div class="card-body">
    <div class="container">
      <h1 class="display-4">Your Albums</h1>
      <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
      <a class="btn btn-primary btn-lg" href="{{route('album.create')}}" role="button">Create New Album</a>
    </div>
  </div>
  <album-index-component></album-index-component>
</div>
@endsection