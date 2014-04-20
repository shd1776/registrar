<?php
	function getParam($name, $required = true) {
		if ($name == null || $name == '') throw new Exception('Parameter name required.');

		if (isset($_POST[$name])) return $_POST[$name];
		else if (isset($_GET[$name])) return $_GET[$name];

		if ($required) throw new Exception('Parameter ' . $name . ' is required');
	}
?>