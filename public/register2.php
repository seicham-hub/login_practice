<?php 

session_start();

$token = $_SESSION['token'];



if(!isset($_SESSION['csrf_token'])  || $token !== $_SESSION['csrf_token']){
	exit('不正なリクエストです');
}

unset($_SESSION['csrf_token']);



?>

<!DOCTYPE html>
<html>
<head>
	<meta name="vieport" content="width= device-width,inicia-scale=1.0">
	<title>ユーザー登録完了画面</title>
</head>
<body>
	<p>ユーザー登録が完了しました。</p>
	<a href="signup_form.php">戻る</a>

</body>
</html>