@extends('layouts.app')
@section('title', '| Upload Image')
@section('content')
    <div class="row justify-content-center">
        <upload-component :album_id ="{{$album_id}}"></upload-component>
    </div>
@endsection
