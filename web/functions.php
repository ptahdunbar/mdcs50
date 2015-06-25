<?php

function clean_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);

	return $data;
}

function getSetting($key)
{
	global $website_settings;

	if ( ! isset($website_settings[$key]) ) {
		return null;
	}

	return $website_settings[$key];
}

/**
 * Get's the current page. Defaults to $_SERVER['REQUEST_URI'].
 *
 * @return string
 */
function getCurrentPage()
{
	$get_request = function($current = null){
		if ( is_null($current) ) {
			$current = $_SERVER['REQUEST_URI'];
		}

		if ( '/' == $current ) {
			$current = '/index.php';
		}

		return $current;
	};

	$current = $get_request();

	return $current;
}

/**
 * Get's a carousel by the ID.
 *
 * @param string $id
 * @return array
 */
function getCarousel($id = null)
{
	global $carousels;

	if ( ! $id ) {
		return [];
	}

	if ( ! isset($carousels[$id]) ) {
		return [];
	}

	return $carousels[$id];
}