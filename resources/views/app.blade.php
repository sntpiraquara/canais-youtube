<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Canais SNT - 2020</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
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

    <footer class="footer">
	  <div class="content has-text-centered">
	    <p>
	      Feito por Neri Junior (neri[at]nerijunior.com) com código aberto no <a href="https://github.com/sntpiraquara/canais-youtube">Github</a>
	    </p>
	  </div>
	</footer>

	@if(isset($cadastro))
    <script>window.cadastro = true;</script>
    @endif
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
