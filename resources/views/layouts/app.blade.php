<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ PUB_URL }}favicon.ico">

    <link href="{{ PUB_URL }}css/app.css?v={{ rand() }}" rel="stylesheet">
    <link href="{{ PUB_URL }}css/browser_detection.css?v={{ rand() }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    @if(Route::currentRouteName() == '')
        <link rel="stylesheet" type="text/css" href="{{ PUB_URL }}css/ruslan_slider.css?v={{ rand() }}">
        <link rel="stylesheet" type="text/css" href="{{ PUB_URL }}css/my_sliders.css?v={{ rand() }}">
    @endif
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div class="container">        
        @include('parts/_browsers')

        @include('parts/menu/_top_nav')

        @yield('content')
    </div>

    @if(Route::currentRouteName() == '')
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>      
        <script src="http://hammerjs.github.io/dist/hammer.min.js" type="text/javascript"></script>
        <script src="{{ PUB_URL }}js/ruslan_slider.js?v={{ rand() }}"></script>
        <script src="{{ PUB_URL }}js/my_sliders.js?v={{ rand() }}"></script>
    @else
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    @endif
    <script src="{{ PUB_URL }}js/notification.js?v={{ rand() }}"></script>
    <script src="{{ PUB_URL }}js/app.js?v={{ rand() }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.js"></script>
    <script src="{{ PUB_URL }}js/browser_detection.js?v={{ rand() }}"></script>
</body>
</html>
