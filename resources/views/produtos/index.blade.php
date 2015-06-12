@extends('layouts.main')
@section('content')
{!! HTML::flash_message() !!}
@include(Pages::page($page))  
@stop