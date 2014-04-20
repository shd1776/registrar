<?php
	header('Content-Type: application/json');
	REQUIRE $_SERVER["DOCUMENT_ROOT"] . '/registrar-api-resources/config.php';
	REQUIRE LIBRARY_PATH . '/department.php';
	REQUIRE LIBRARY_PATH . '/error.php';
	

	$start = 0;
	$end = 0;

	if (isset($_POST['start'])) {
		$start = $_POST['start'];
	} else {
		if (isset($_GET['start'])) {
			$start = $_GET['start'];
		} else {
			$error = new Error(0, 'start index is required');
			echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
			die;
		}
	}

	if (isset($_POST['end'])) {
		$end = $_POST['end'];
	} else {
		if (isset($_GET['end'])) {
			$end = $_GET['end'];
		} else {
			$error = new Error(0, 'end index is required');
			echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
			die;
		}
	} 

	try {
		$mysqli = db_create();
		$department = department_list($mysqli, $start, $end);
		echo json_encode($department, JSON_PRETTY_PRINT);
	} catch (Exception $e){
		$error = new Error(1, $e->getMessage());
		echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
	}
?>