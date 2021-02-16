@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code')

4<i class="bx bx-buoy bx-spin text-primary display-3"></i>3

@endsection
@section('message', __($exception->getMessage() ?: 'Forbidden'))
