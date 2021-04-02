<?php

require_once('env2.php');

/**
 * データベース接続
 * @param 
 * @return instance $pdo
 */

function dbConnect (){

	$host = DB_HOST;
	$dbname = DB_NAME;
	$user   = DB_USER;
	$dbpass = DB_PASS;

	$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";


	try{
		$pdo = new PDO($dsn,$user,$dbpass,[
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_EMULATE_PREPARES => false,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	]);
		return $pdo;

	}catch(PDOException $e){
		echo '接続失敗です'.$e->getMessage();
		exit();

	}

}
	
dbConnect();


?>