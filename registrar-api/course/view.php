<?php
	header('Content-Type: application/json');
	require_once $_SERVER["DOCUMENT_ROOT"] . '/registrar-resources/config.php';
	require_once LIBRARY_PATH . '/course.php';
	require_once LIBRARY_PATH . '/error.php';
	require_once LIBRARY_PATH . '/param.php';

	$course_id = null;

	try {
		$course_id = getParam('course_id');
	} catch (Exception $e){
		$error = new Error(0, $e->getMessage());
		echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
		die;
	}
	
	try {
		$mysqli = db_create();
		echo json_encode(course_get($mysqli, $course_id), JSON_PRETTY_PRINT);
	} catch (Exception $e) {
		$error = new Error(1, $e->getMessage());
		echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
		die;
	}
?>