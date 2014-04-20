<?php
	function db_create()
	{
		$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DBNAME);

		if ($mysqli->connect_errno)
			throw new Exception('Error connecting to database: ' . $mysqli->connect_errno);

		return $mysqli;
	}

	function getUpdateString($varsByPropName) {
		$updateString = '';
		foreach($varsByPropName as $propName => $var) {
			if ($updateString != '')
				$updateString .= ', ';
			$updateString .= '`' . $propName . '`=' . $var;
		}
		return $updateString;
	}
?>