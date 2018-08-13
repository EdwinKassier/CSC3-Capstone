<?php

	ob_start();

	session_start();
	// session_destroy();

	define('SITENAME', 'BlackEagle Project');
	define('APPROOT', dirname(dirname(__FILE__)));
	define('URLROOT', 'http://localhost/CSC3-Capstone');

	defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

	defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", APPROOT . DS . "views/templates/front");
	defined("TEMPLATE_BACK") ? null : define("TEMPLATE_ADMIN", APPROOT . DS . "views/templates/admin");

	//DB params
	defined("DB_HOST") ? null : define("DB_HOST", "localhost");
	defined("DB_USER") ? null : define("DB_USER", "root");

	defined("DB_PASS") ? null : define("DB_PASS", "");
	defined("DB_NAME") ? null : define("DB_NAME", "blackeagle_db");
?>