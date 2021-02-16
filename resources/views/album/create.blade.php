@extends('layouts.app')
 @section('css')
        <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet')}}">
        <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css')}}" />
 @endsection
     
@section('content')
        <album-component>
        </album-component>
@endsection

@section('js')
       <!-- bootstrap datepicker -->
        <script src="{{asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <!-- dropzone plugin -->
        <script src="{{asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
@endsection
