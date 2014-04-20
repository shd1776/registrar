<?php
	defined('DB_HOST')			or define('DB_HOST', 'localhost');
	defined('DB_USERNAME')		or define('DB_USERNAME', 'root');
	defined('DB_PASSWORD')		or define('DB_PASSWORD', 'granger123');
	defined('DB_DBNAME')		or define('DB_DBNAME', 'cs434');
	defined("LIBRARY_PATH")		or define("LIBRARY_PATH", $_SERVER['DOCUMENT_ROOT'] . '/registrar-resources/lib');
	defined("TEMPLATES_PATH")	or define("TEMPLATES_PATH", $_SERVER['DOCUMENT_ROOT'] . '/registrar-resources/templates');
	defined("JAVASCRIPT_PATH")	or define("JAVASCRIPT_PATH", $_SERVER['DOCUMENT_ROOT'] . '/registrar/js');
	defined("CSS_PATH")			or define("CSS_PATH", '/registrar/css');
	defined("DOCUMENT_ROOT")	or define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
?>