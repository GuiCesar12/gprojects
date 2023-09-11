<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ URL::asset('resources/img/icons/icon-48x48.png') }}" /><link rel="stylesheet" f="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css" integrity="sha512-T3VL1q6jMUIzGLRB9z86oJg9PgF7A55eC2XkB93zyWSqQw3Ju+6IEJZYBfT7E9wOHM7HCMCOZSpcssxnUn6AeQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="canonical" href="https://demo-basic.adminkit.io/" />
	<link rel="stylesheet" href="https://unpkg.com/vis-timeline/dist/vis-timeline-graph2d.min.css" type="text/css">

	<title>TrackTrace RX - GProjects</title>
	
	<link href="{{ URL::asset('resources/css/app.css')}}" rel="stylesheet">
	<link href="{{ URL::asset('resources/css/style.css')}}" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	@stack('links')
</head>

<body>
	<div class="wrapper">
		

		<div class="main">
				

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>@yield('title1')</strong> @yield('title2')</h1>
					@yield('content')
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://https://www.tracktracerx.com" target="_blank"><strong>TrackTrace RX</strong></a> - <a class="text-muted" href="#"><strong>GProjects</strong></a>								&copy;
							</p>
						</div>
						
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="{{ URL::asset('resources/js/app.js') }}"></script>
	<script src="{{ URL::asset('resources/js/index.js') }}"></script>
	<script src="{{ URL::asset('resources/js/main.js') }}"></script>
	<script src="{{ URL::asset('resources/js/chart.js') }}"></script>
	<script src="https://unpkg.com/vis-timeline/standalone/umd/vis-timeline-graph2d.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	@stack('scripts')

</body>

</html>