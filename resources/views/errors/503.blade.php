@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code')

5<i class="bx bx-buoy bx-spin text-primary display-3"></i>3

@endsection
@section('message', __($exception->getMessage() ?: 'Service Unavailable'))
