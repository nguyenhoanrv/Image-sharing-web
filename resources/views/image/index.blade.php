@extends('layouts.app')

@section('content')
  <image-index-component :album = "{{$album}}"></image-index-component>
  <comment-component :album_id = "{{$album->id}}" :user="{{$album->user}}"></comment-component>
@endsection
