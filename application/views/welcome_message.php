<html lang="en">
<head>
	<title>Codeigniter 3</title>

	<!-- favicon -->
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url().'assets/favicon/apple-icon-57x57.png'; ?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url().'assets/favicon/apple-icon-60x60.png'; ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url().'assets/favicon/apple-icon-72x72.png'; ?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url().'assets/favicon/apple-icon-76x76.png'; ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url().'assets/favicon/apple-icon-114x114.png'; ?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url().'assets/favicon/apple-icon-120x120.png'; ?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url().'assets/favicon/apple-icon-144x144.png'; ?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url().'assets/favicon/apple-icon-152x152.png'; ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url().'assets/favicon/apple-icon-180x180.png'; ?>">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url().'assets/favicon/android-icon-192x192.png'; ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url().'assets/favicon/favicon-32x32.png'; ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url().'assets/favicon/favicon-96x96.png'; ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url().'assets/favicon/favicon-16x16.png'; ?>">
	<link rel="manifest" href="<?php echo base_url().'assets/favicon/manifest.json' ?>">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo base_url().'assets/favicon/ms-icon-144x144.png'; ?>">
	<meta name="theme-color" content="#ffffff">
	<!-- favicon -->
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	
	<!-- Angular JS -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>  
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>

	<!-- MY App -->
	<script src="app/packages/dirPagination.js"></script>
	<script src="app/routes.js"></script>
	<script src="app/services/myServices.js"></script>
	<script src="app/helper/myHelper.js"></script>

	<!-- App Controller -->
	<script src="app/controllers/ItemController.js"></script>

</head>
<body ng-app="main-App">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Codeigniter 3</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="#/">Home</a></li>
					<li><a href="#/items">Item</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<ng-view></ng-view>
	</div>

</body>
</html>
