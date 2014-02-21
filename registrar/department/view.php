<?php
	REQUIRE_ONCE $_SERVER['DOCUMENT_ROOT'] . '/registrar-resources/config.php';
	REQUIRE_ONCE LIBRARY_PATH . '/department.php';
	REQUIRE_ONCE LIBRARY_PATH . '/db.php';
	REQUIRE_ONCE LIBRARY_PATH . '/param.php';

	$department = null;

	try {
		$dept_id = getParam('dept_id');
		$mysqli = db_create();
		$department = department_get($mysqli, $dept_id);
	} catch (Exception $e) {
		$_SESSION['ERROR'] = $e->getMessage();
	}

	REQUIRE_ONCE TEMPLATES_PATH . '/header.php';
?>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title"><?=$department->college?><?=$department->dept_name?></h2>
		</div>
	</div>
</div>