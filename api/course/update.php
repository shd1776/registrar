<?php
	header('Content-Type: application/json');
	REQUIRE $_SERVER["DOCUMENT_ROOT"] . '/registrar-api-resources/config.php';
	REQUIRE LIBRARY_PATH . '/course.php';
	REQUIRE LIBRARY_PATH . '/error.php';
	REQUIRE LIBRARY_PATH . '/param.php';

	$course_id = null;
	$course_title = null;
	$course_hours = null;
	$course_dept_id = null;

	try {
		$course_id = getParam('course_id');
		$course_title = getParam('title', false);
		$course_hours = getParam('hours', false);
		$course_dept_id = getParam('dept_id', false);
	} catch (Exception $e){
		$error = new Error(0, $e->getMessage());
		echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
		die;
	} 
	
	try {
		$mysqli = db_create();
		$course = new Course($course_id, $course_title, $course_hours, $course_dept_id);
		echo json_encode(course_update($mysqli, $course), JSON_PRETTY_PRINT);
	} catch (Exception $e) {
		$error = new Error(1, $e->getMessage());
		echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
		die;
	}
?>