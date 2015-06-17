<?php

require_once 'functions.php';

$website_settings = [
	'title' => 'Pirate Islands, LLC',
	'home' => 'Pirate Life',
	'page_title' => 'Ship wreak',
	'page_description' => 'List of all my ship wreaks',
	'copyright' => 'Copyright &copy; Pirate Islands %s',
];

$portfolio_collection = [
	[
		'container_class' => 'col-md-3 img-portfolio',
		'img_class' => 'img-responsive img-hover',
		'portfolio_link' => 'portfolio-item.php',
		'img_link' => 'http://lorempixel.com/g/750/450',
	],
	[
		'container_class' => 'col-md-3 img-portfolio',
		'img_class' => 'img-responsive img-hover',
		'portfolio_link' => 'portfolio-item.php',
		'img_link' => 'http://lorempixel.com/g/750/450',
	],
	[
		'container_class' => 'col-md-3 img-portfolio',
		'img_class' => 'img-responsive img-hover',
		'portfolio_link' => 'portfolio-item.php',
		'img_link' => 'http://lorempixel.com/g/750/450',
	],
	[
		'container_class' => 'col-md-3 img-portfolio',
		'img_class' => 'img-responsive img-hover',
		'portfolio_link' => 'portfolio-item.php',
		'img_link' => 'http://lorempixel.com/g/750/450',
	],
];

$portfolio_collection = array_merge(
	$portfolio_collection,
	$portfolio_collection,
	$portfolio_collection
);
