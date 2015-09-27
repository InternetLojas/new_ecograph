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
<!-- Latest compiled and minified CSS & JS -->

<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{asset(elixir('css/main.css'))}}">

<!--<link rel="stylesheet" href="{asset('build/css/main-7b19e2bd.css')} ">-->

<!-- Favicons-->
<!--================================================== -->
<link rel="shortcut icon" href="images/icons/favicon.ico">
<link rel="icon" href="images/icons/favicon.ico">
<!-- Basic Page Needs ================================================== -->