@extends('layouts.main')
<?php $page = 'login'; $title= 'Acesso ao site'; $layout = Layout::classes('0');?>
@section('content')
<!-- /#páginas home -->
@include(Pages::page('login'))        
<!-- / páginas home -->
@stop
