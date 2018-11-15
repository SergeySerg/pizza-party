<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Nextsite | Панель керування</title>

	<link rel="shortcut icon" href="{{ asset('/img/favicon/favicon.ico') }}" type="image/x-icon">
	<link rel="apple-touch-icon" href="{{ asset('/img/favicon/apple-touch-icon.png') }}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon/apple-touch-icon-72x72.png') }}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/img/favicon/apple-touch-icon-114x114.png') }}">

	<!--basic styles-->
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/backend/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/backend/bootstrap-responsive.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/backend/font-awesome.min.css') }}" rel="stylesheet">
	<!--Тестовый css-->
	<link href="{{ asset('/css/backend/backend.css') }}" rel="stylesheet">

	<!--[if IE 7]>
	<link href="{{ asset('/css/backend/font-awesome-ie7.min.css') }}" rel="stylesheet">
	<![endif]-->
	<!--js-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" type="text/javascript" ></script>
	<!--<script src="{{ asset('/js/backend/articles.js') }}"type="text/javascript"></script>
	<script src="{{ asset('/js/backend/jquery.ui.touch-punch.min.js') }}"type="text/javascript"></script>
	<script src="{{ asset('/js/backend/jquery-ui-1.10.3.custom.min.js') }}"type="text/javascript"></script>
	<script src="{{ asset('/js/backend/global.js') }}"type="text/javascript"></script>
	<script src="{{ asset('/js/backend/jquery.slimscroll.min.js') }}"type="text/javascript"></script>-->

	<!--page specific plugin styles-->

	<!--<link href="{{ asset('/css/backend/jquery-ui-1.10.3.custom.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/backend/chosen.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/backend/datepicker.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/backend/bootstrap-timepicker.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/backend/daterangepicker.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/backend/colorpicker.css') }}" rel="stylesheet">-->


	<!--fonts-->

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" type='text/css' />
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!--ace styles-->
	<link href="{{ asset('/css/backend/ace.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/backend/ace-responsive.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/backend/ace-skins.min.css') }}" rel="stylesheet">

	<!--[if lte IE 8]>
	<link rel="stylesheet" href="{{ asset('/css/backend/ace-ie.min.css') }} >
    <![endif]-->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
	<![endif]-->
</head>
<!--<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Home</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	-->
<body class="login-layout">
<div class="main-container container-fluid">
	<div class="main-content">
		<div class="row-fluid">
			<div class="span12">
				<div class="login-container">
					<div class="row-fluid">
						<div class="center">
							<h1>
								<span class="red">{{$_SERVER['HTTP_HOST']}}</span>
								<span class="white"></span>
							</h1>
						</div>
					</div>

					<div class="space-6"></div>

					<div class="row-fluid">
						<div class="position-relative">
							@yield('content')
						</div><!--/position-relative-->
					</div>
				</div>
			</div><!--/.span-->
		</div><!--/.row-fluid-->
	</div>
</div><!--/.main-container-->

<!--basic scripts-->

<!--[if !IE]>-->

<script src="{{ asset('/js/backend/bootstrap.min.js') }}"></script>

<!--page specific plugin scripts-->

<!--<script src="{{ asset('/js/backend/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/js/backend/jquery.dataTables.bootstrap.js') }}"></script>-->

<!--Для страницы form elements-->

<!--<script src="{{ asset('/js/backend/chosen.jquery.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/fuelux.spinner.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/bootstrap-datepicker.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/bootstrap-timepicker.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/moment.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/daterangepicker.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/bootstrap-colorpicker.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/jquery.knob.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/jquery.autosize-min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/jquery.inputlimiter.1.3.1.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/jquery.maskedinput.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/bootstrap-tag.min.js') }}"type="text/javascript"></script>-->
<!--ace scripts-->

<script src="{{ asset('/js/backend/ace-elements.min.js') }}"></script>
<script src="{{ asset('/js/backend/ace.min.js') }}"></script>

<!--inline scripts related to this page-->
<script type="text/javascript">
	function show_box(id) {
		$('.widget-box.visible').removeClass('visible');
		$('#'+id).addClass('visible');
	}
</script>
</body>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
