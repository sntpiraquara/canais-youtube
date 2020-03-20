<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Canais SNT - 2020</title>

    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
</head>
<body>
    <div id="app">

		<div class="container">
			@if(session('success'))
			<div class="section">
				<div class="notification is-success">Link criado!</div>
			</div>
			@endif

			@if(session('duplicated'))
			<div class="section">
				<div class="notification is-danger">Este link já foi cadastrado!</div>
			</div>
			@endif
		</div>

    	<app></app>
    </div>

    <script src="{{ secure_asset('js/app.js') }}"></script>
</body>
</html>
