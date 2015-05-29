<!-- Basic Page Needs ================================================== -->
<meta charset="utf-8">
@if($page=='detalhes_')
{{ Metatags::title($title,$price) }}
@else
{{ Metatags::title($title) }}
@endif
<!-- Mobile Specific Metas ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!--meta tags principais-->
{{ Metatags::tags() }}

@if($page=='detalhes_')
<!--meta tags facebook-->
{{ Metatags::tagsfacebook($descricao, $detalhes) }}
@endif
<!-- CSS ================================================== -->

<!-- web font  --      
<link href='http://fonts.googleapis.com/css?family=Raleway:300,400,700,800,900' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>-->

<!-- CSS METRO  -->
<link rel="stylesheet" href="{{ asset('/css/metro-bootstrap.css')}}">
<link rel="stylesheet" href="{{ asset('/css/metro-bootstrap-responsive.css')}}">
<link rel="stylesheet" href="{{ asset('/css/iconFont.css')}}">
<link rel="stylesheet" href="{{ asset('/css/custom.css')}}">
<link rel="stylesheet" href="{{ asset('/uploads/css/jquery.fileupload.css')}}">
<!-- Favicons-->
<!--================================================== -->
<link rel="shortcut icon" href="images/icons/favicon.ico">
<link rel="icon" href="images/icons/favicon.ico">

