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

	defined("DB_HOST") ? null : define("DB_HOST", "localhost");
	defined("DB_USER") ? null : define("DB_USER", "root");

	defined("DB_PASS") ? null : define("DB_PASS", "");
	defined("DB_NAME") ? null : define("DB_NAME", "blackeagle_db");

	//Set DSN
	$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

	//Create a PDO instance
	$pdo = new PDO($dsn, DB_USER, DB_PASS);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

	// #++++++++++++ EXAMPLE ++++++++++++#
	//QUERY
	// $status = 'admin';

	// $sql = 'SELECT * FROM users WHERE status = :status';
	// $stmt = $pdo->prepare($sql);
	// $stmt->execute(['status' => $status]);
	// $users = $stmt->fetchAll();

	// foreach($users as $user){
	// 	echo $user->name.'<br>';
	// }

	//INSERT
	// $name = 'Karen Williams';
	// $email = 'kwills@example.com';
	// $status = 'guest';

	// $sql = 'INSERT INTO users(name, email, status) VALUES(:name, :email, :status)';
	// $stmt = $pdo->prepare($sql);
	// $stmt->execute(['name'=> $name, 'email' => $email, 'status' => $status]);
	// echo 'Added User';
	// #++++++++++++ END EXAMPLE ++++++++++++#



	//Old way for just mysql
	// $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	// require_once("class.site_functions.php");

?>