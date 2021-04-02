<?php 

session_start();

require_once('../functions2.php');


$err = $_SESSION;

?>


<!DOCTYPE html>
<html>
<head>
	<meta name="vieport" content="width= device-width,inicia-scale=1.0">
	<title>ユーザログインフォーム</title>
</head>
<body>

	<?php if (isset($err['msg'])) : ?>
		<p><?php echo h($err['msg']) ?></p>
	<?php endif ?>

	<h2>ユーザログインフォーム</h2>

	<form action="login2.php" method="POST" >

		<p>
			<label for="mail">メールアドレス</label>
			<input id="mail" type="mail" name="mail" >
		</p>
		<p>
			<?php if (isset($err['mail'])): ?>
			<?php echo $err['mail'] ?>
			<?php endif ?>	
		</p>

		<p>
			<label for="password">パスワード</label>
			<input id="password" type="password" name="password">
		</p>
		<p>
			<?php if (isset($err['password'])): ?>
			<?php echo $err['password'] ?>
			<?php endif ?>	
		</p>

	

		<input type="submit" name="submit" >

	</form>

</body>
</html>