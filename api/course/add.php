<?php
	header('Content-Type: application/json');
	REQUIRE $_SERVER["DOCUMENT_ROOT"] . '/registrar-resources/config.php';
	REQUIRE LIBRARY_PATH . '/course.php';
	REQUIRE LIBRARY_PATH . '/error.php';
	REQUIRE LIBRARY_PATH . '/param.php';

	$course = null;

	try {
		$course = new Course(getParam('id'), getParam('title'), getParam('hours'), getParam('dept_id'));
	} catch (Exception $e){
		$error = new Error(0, $e->getMessage());
		echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
		die;
	}

	try {
		$mysqli = db_create();
		echo json_encode(course_add($mysqli, $course), JSON_PRETTY_PRINT);
	} catch (Exception $e) {
		$error = new Error(1, $e->getMessage());
		echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
		die;
	}
?>