<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')Laravel Packages Registry</title>
	<link href="{{ URL::asset('app/img/favicon.png') }}" rel="shortcut icon"/>
  <meta name='apple-mobile-web-app-capable' content='yes' />
  <meta name='apple-touch-fullscreen' content='yes' />
  <meta name='viewport' content='width=device-width, initial-scale=1.0' />
	{{ Basset::show('application.css') }}
</head>
<body>
	@yield('layout')
	{{ Basset::show('application.js') }}
	@yield('js')
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-728496-10']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
</body>
</html>