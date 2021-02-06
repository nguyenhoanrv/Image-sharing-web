@extends('layouts.app')

@section('content')
  <image-index-component :album = "{{$album}}"></image-index-component>
@endsection
