<?php 
session_start();

require_once(__DIR__.'/../classes/UserLogic2.php');
require_once(__DIR__.'/../functions2.php');


// ログインしているか判定
$result = UserLogic2::checkLogin();

if(!$result){
	$_SESSION['login_err'] = 'ユーザーを登録してログインしてください。';
	header('Location:signup_form2.php');
	exit();
}


$login_user = $_SESSION['login_user'];


?>

<!DOCTYPE html>
<html>
<head>
	<meta name="vieport" content="width= device-width,inicia-scale=1.0">
	<title>マイページ</title>
</head>
<body>
	<h2>マイページ</h2>
	<p>ログインユーザー：<?php echo h($login_user['name']) ?></p>
	<p>メールアドレス：<?php echo h($login_user['email']) ?></p>

	<form action="logout2.php" method="post">
		<input type="submit" name="logout" value="ログアウト">
	</form>


</body>
</html>