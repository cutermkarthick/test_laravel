<!doctype html>
<html>
<head>
<!-- my head section goes here -->
<!-- my css and js goes here -->
</head>
<body>
<div class="container">
  <header> @include('template.header') </header>

  <div class="contents"> @yield('content') </div>
  <footer> @include('template.footer') </footer>
</div>
</body>
</html>