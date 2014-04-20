<?php
	header('Content-Type: application/json');
	require_once $_SERVER["DOCUMENT_ROOT"] . '/registrar-resources/config.php';
	require_once LIBRARY_PATH . '/course.php';
	require_once LIBRARY_PATH . '/error.php';
	require_once LIBRARY_PATH . '/param.php';

	$start = 1;
	$end = 26;

	try {
		$start = getParam('start');
		$end = getParam('end');
	} catch (Exception $e){
		if ($start == null) $start = 1;
		if ($end == null) $start = 26;
	}
	
	try {
		$mysqli = db_create();
		echo json_encode(course_list($mysqli, $start, $end), JSON_PRETTY_PRINT);
	} catch (Exception $e) {
		$error = new Error(1, $e->getMessage());
		echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
		die;
	}
?>