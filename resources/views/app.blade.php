<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Canais SNT - 2020</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">

		<div class="container">
			@if(session('success'))
			<div class="notification is-success">Link criado!</div>
			@endif
		</div>

    	<app></app>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
