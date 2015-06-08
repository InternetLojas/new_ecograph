@extends('layouts.main_produtos')
@section('content')
{!! HTML::flash_message() !!}
@include(Pages::page($page))  
@stop