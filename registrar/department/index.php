<?php
	REQUIRE_ONCE $_SERVER['DOCUMENT_ROOT'] . '/registrar-resources/config.php';
	REQUIRE_ONCE LIBRARY_PATH . '/department.php';
	REQUIRE_ONCE LIBRARY_PATH . '/db.php';
	REQUIRE_ONCE LIBRARY_PATH . '/param.php';

	$departments = array();

	$page = getParam('page', false);
	if ($page == null) $page = 0;

	$startIndex = $page * 25 + 1;
	$endIndex = $page + 26;

	try {
		$mysqli = db_create();
		$departments = department_list($mysqli, $startIndex, $endIndex);
	} catch (Exception $e) {
		$_SESSION['ERROR'] = $e->getMessage();
	}


	REQUIRE_ONCE TEMPLATES_PATH . '/header.php';
?>
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h2 class="panel-title">Departments</h2>
		</div>
		<table class="table">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>College</th>
			</tr>
			<?php foreach($departments as $department) {?>
			<a href="view.php?dept_id=<?=$department->dept_id?>">
				<tr>
					<td><?=$department->dept_id?></td>
					<td><a href="view.php?dept_id=<?=$department->dept_id?>"><?=$department->dept_name?></a></td>
					<td><?=$department->college?></td>
				</tr>

			<?php } ?>

		</table>
	</div>
</div>