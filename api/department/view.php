<?php
	header('Content-Type: application/json');
	REQUIRE $_SERVER["DOCUMENT_ROOT"] . '/registrar-api-resources/config.php';
	REQUIRE LIBRARY_PATH . '/department.php';
	REQUIRE LIBRARY_PATH . '/error.php';


	$dept_id = 0;

	if (isset($_POST['dept_id'])) {
		$dept_id = $_POST['dept_id'];
	} else {
		if (isset($_GET['dept_id'])) {
			$dept_id = $_GET['dept_id'];
		} else {
			$error = new Error(0, 'department id is required');
			echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
			die;
		}
	} 

	try {
		$mysqli = db_create();
		$department = department_get($mysqli, $dept_id);
		echo json_encode($department, JSON_PRETTY_PRINT);
	} catch (Exception $e){
		$error = new Error(1, $e->getMessage());
		echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
	}
?>