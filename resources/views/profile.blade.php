@extends('layouts.app')

@section('content')
<div class="container" id="app">
    <profile-component :user = "{{$user}}"  :is_following="{{json_encode($is_following ??false) }}" :followers_count = "{{json_encode($followers)}}" :followings_count="{{$followings}}" :me_id = "{{$me_id ?? null}}"></profile-component>
</div>
@endsection
