<?php
	header('Content-Type: application/json');
	REQUIRE $_SERVER["DOCUMENT_ROOT"] . '/registrar-api-resources/config.php';
	REQUIRE LIBRARY_PATH . '/department.php';
	REQUIRE LIBRARY_PATH . '/error.php';


	$department = new Department(null, null, null);

	if (isset($_POST['dept_id'])) {
		$department->dept_id = $_POST['dept_id'];
	} else {
		if (isset($_GET['dept_id'])) {
			$department->dept_id = $_GET['dept_id'];
		} else {
			$error = new Error(0, 'department id is required');
			echo json_encode(array('error' => $error), JSON_PRETTY_PRINT);
			die;
		}
	}

	if (isset($_POST['dept_name'])) {
		$department->dept_name = $_POST['dept_name'];
	} else {
		if (isset($_GET['dept_name'])) {
			$department->dept_name = $_GET['dept_name'];
		}
	}

	if (isset($_POST['college'])) {
		$department->college = $_POST['college'];
	} else {
		if (isset($_GET['college'])) {
			$department->college = $_GET['college'];
		}
	}

	try {
		$mysqli = db_create();
		echo json_encode(department_update($mysqli, $department), JSON_PRETTY_PRINT);
	} catch (Exception $e){
		echo json_encode(array('error' => new Error(1, $e->getMessage())), JSON_PRETTY_PRINT);
		die;
	}
?>