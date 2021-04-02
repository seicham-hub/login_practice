<?php
session_start();

require_once('../classes/UserLogic2.php');

if(!$logout = filter_input(INPUT_POST,'logout')){
	exit('不正なアクセスです');
}

// ログインしているか判定
$result = UserLogic2::checkLogin();

if(!$result){
	exit('セッションが切れましたので、ログインしなおしてください');
}

UserLogic2::logout();



?>

<!DOCTYPE html>
<html>
<head>
	<meta name="vieport" content="width= device-width,inicia-scale=1.0">
	<title>ログアウト</title>

</head>
 <body>
 	<h2>ログアウト完了</h2>
 	<p>ログアウトしました</p>
 	<a href="login_form2.php">ログイン画面へ</a>
 </body>
 </html>