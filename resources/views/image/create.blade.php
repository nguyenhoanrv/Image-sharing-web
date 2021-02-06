@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
            <upload-component :album_id ="{{$album_id}}"></upload-component>
        </div>
    </div>
@endsection
