<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- <meta name="csrf-token" content="<?php //echo csrf_token(); ?>"> -->

        <script>
            window.Laravel = { csrfToken: '{{ csrf_token() }}' }
            //window.Laravel = <?php //echo json_encode([ 'csrfToken' => csrf_token(), ]); ?>
        </script>

        <link href="css/app.css" rel="stylesheet">

        <title>Laravel</title>

    </head>
    <body>
        <div id="app">
			<Blogs></Blogs>
            <Blog></Blog>
        </div>

        <script src="js/app.js"></script>

        <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    </body>
</html>
