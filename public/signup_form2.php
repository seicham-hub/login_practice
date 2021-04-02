<?php 

session_start();

require_once ('../classes/UserLogic2.php');
require_once('../functions2.php');



if($_SERVER['REQUEST_METHOD'] === 'POST'){
	

	//サニタイズ
	$post = sanitize(INPUT_POST);


	//バリデーション

	$err =[];


	if(empty($post['username'])){
		$err['username'] = 'ユーザー名を入力してください。';
	}
	if(empty($post['mail'])){
		$err['mail'] = 'メールアドレスを入力してください。';
	}


	// パスワードの正規表現
	if(!preg_match("/\A[a-z\d]{8,100}/i",$post['password'])){
		$err['password'] = 'パスワードは英数字8文字以上100文字以下にしてください。';
	}
	if(empty($post['password_confirm'])){
		$err['password_confirm'] = '確認用パスワードを入力してください。';
	}

	if($post['password'] !== $post['password_confirm']){
		$err['pas'] = 'パスワードが一致していません。';
	}



	if(empty($err)){

		$_SESSION['token'] = $_POST['csrf_token'];
		
		$hasCreated = UserLogic2::createUser($post);



		if(!$hasCreated){
			echo '登録に失敗しました。';
			exit();		
		}

		$_SESSION['token'] = $post['csrf_token'];

		header('Location:register2.php');
		exit();
		
	}

}

 ?>



<!DOCTYPE html>
<html>
<head>
	<meta name="vieport" content="width= device-width,inicia-scale=1.0">
	<title>ユーザー登録フォーム</title>
</head>
<body>

	<h2>ユーザー登録フォーム</h2>

	<?php if (isset($_SESSION['login_err'])): ?>
	<?php echo $_SESSION['login_err']  ?>
	<?php endif ?>	

	<form action="<?php echo h($_SERVER["PHP_SELF"]) ; ?>" method="POST" >
		<p>
			<label for="username">ユーザー名</label>
			<input id="username" type="text" name="username" value="<?php echo h($post['username']) ?>"> 
		</p>

		<p>
			<?php if (isset($err['username'])): ?>
			<?php echo $err['username']  ?>
			<?php endif ?>	
		</p>

		<p>
			<label for="mail">メールアドレス</label>
			<input id="mail" type="mail" name="mail" value="<?php echo h($post['mail']) ?>">
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

		<p>
			<label for="password_confirm">パスワード確認</label>
			<input id="password_confirm" type="password" name="password_confirm">
		</p>
		<p>
			<?php if (isset($err['password_confirm'])): ?>
			<?php echo $err['password_confirm'] ?>
			<?php endif ?>
			<?php if (isset($err['pas'])): ?>
			<?php echo $err['pas'] ?>
			<?php endif ?>
		</p>

		<input type="hidden" name="csrf_token" value="<?php echo h(setToken()) ?>">

		<input type="submit" name="submit" >

	</form>

</body>
</html>