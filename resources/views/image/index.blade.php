@extends('layouts.app')
@section('title', '| View Album')
@section('content')
  <image-index-component :album = "{{$album}}"></image-index-component>
  <comment-component :album_id = "{{$album->id}}" :user="{{auth()->user()}}"></comment-component>
@endsection
