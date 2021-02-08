@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12 text-center m-4">
    <h1 >{{$category->name}}</h1>

    </div>
  </div>
  <div class="row">
  @foreach($category->albums as $album) 
  <div class="card mr-4 col-3" style="width: 16rem;">
    <img class="card-img-top" src="{{'/album/'.$album->image}}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{$album->name}}</h5>
      <p class="card-text">{{$album->description}}</p>
      <a href="{{route('image-view', ['id'=>$album->id])}}" class="btn btn-primary">View Album</a>
    </div>
    </div>
  @endforeach
    </div>

</div>
@endsection