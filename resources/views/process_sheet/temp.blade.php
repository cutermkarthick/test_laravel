<!doctype html>
<html>
	<title>PSM</title>
	<head>
		<script type="text/javascript" src="{{ asset('assets/scripts.bom.js') }}"></script>
	</head>
	<body>
		<div class="container">
		  	<header> @include('template.header') </header>
			<div class="contents"> @yield('content') </div>
			<footer> @include('template.footer') </footer>
		</div>
	</body>
</html>

