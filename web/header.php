<?php require_once 'bootstrap.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?= $website_settings['title']; ?></title>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/modern-business.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><?= $website_settings['home']; ?></a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="about.php">About</a>
				</li>
				<li>
					<a href="services.php">Services</a>
				</li>
				<li>
					<a href="contact.php">Contact</a>
				</li>
				<li class="dropdown active">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Portfolio <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="portfolio-1-col.php">1 Column Portfolio</a>
						</li>
						<li>
							<a href="portfolio-2-col.php">2 Column Portfolio</a>
						</li>
						<li>
							<a href="portfolio-3-col.php">3 Column Portfolio</a>
						</li>
						<li class="active">
							<a href="portfolio-4-col.php">4 Column Portfolio</a>
						</li>
						<li>
							<a href="portfolio-item.php">Single Portfolio Item</a>
						</li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Blog <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="blog-home-1.php">Blog Home 1</a>
						</li>
						<li>
							<a href="blog-home-2.php">Blog Home 2</a>
						</li>
						<li>
							<a href="blog-post.php">Blog Post</a>
						</li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Pages <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li>
							<a href="full-width.php">Full Width Page</a>
						</li>
						<li>
							<a href="sidebar.php">Sidebar Page</a>
						</li>
						<li>
							<a href="faq.php">FAQ</a>
						</li>
						<li>
							<a href="404.php">404</a>
						</li>
						<li>
							<a href="pricing.php">Pricing Table</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</div>
	<!-- /.container -->
</nav>