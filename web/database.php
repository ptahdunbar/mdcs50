<?php

try {

	$db = new PDO(
		sprintf(
			'mysql:host=%s;dbname=%s',
			$config['db']['host'],
			$config['db']['name']
		),
		$config['db']['user'],
		$config['db']['password']
	);

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	echo $e->getMessage();
	die;
}

return $db;