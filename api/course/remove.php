<?php
	//header('Content-Type: application/json');
	REQUIRE $_SERVER["DOCUMENT_ROOT"] . '/registrar-api-resources/config.php';
	REQUIRE LIBRARY_PATH . '/course.php';
	REQUIRE LIBRARY_PATH . '/error.php';
	REQUIRE LIBRARY_PATH . '/param.php';

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
		course_remove($mysqli, $course_id);
	} catch (Exception $e) {
		$error = new Error(1, $e->getMessage());
		echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
		die;
	}
?>