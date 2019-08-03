	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="MO_myDzjmrO4EOqwioyeOF47ZpR-vCy-lM-jiwSBUJ4" />
    <meta name="yandex-verification" content="230c20a693836a24" />
    <meta name="msvalidate.01" content="CE8637FDE057187233F29ED44A6B9C4D" />
    <meta name="pinvert" content="pinvert-verification" />
  <link rel="shortcut icon" type="image/x-icon" href="/img/red.ico">
  <link href="/img/red.ico" rel="apple-touch-icon">
  <link rel="alternate" hreflang="id" href="{{Request::url()}}" />
	<title>@yield('title') - Tonovel</title>
	<link href="/manifest.json" rel="manifest"> 
@yield('metaku')

@if(isset($_COOKIE['theme-mode']) && $_COOKIE['theme-mode'] != 'default')
<link id="bs-theme" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/{{ $_COOKIE['theme-mode'] }}/bootstrap.min.css" rel="stylesheet">
@elseif(isset($_COOKIE['theme-mode']) && $_COOKIE['theme-mode'] == 'default')
<link id="bs-theme" href="{{ URL::asset('css/base.css') }}" rel="stylesheet">
@else
{{ Html::style('css/compile.css?v=296139909') }}
@endif
@yield('stylesheets')
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
