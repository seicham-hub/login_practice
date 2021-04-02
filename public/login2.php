<?php  

session_start();

$_SESSION = array();

require_once('../classes/UserLogic2.php');
require_once('../functions2.php');

//バリデーション
	$post = sanitize(INPUT_POST);


	$err =[];

	if(empty($post['mail'])){
		$err['mail'] = 'メールアドレスを入力してください。';
	}


	// パスワードの正規表現
	if(!preg_match("/\A[a-z\d]{8,100}/i",$post['password'])){
		$err['password'] = 'パスワードは英数字8文字以上100文字以下にしてください。';
	}



	if(count($err) > 0){


		// エラーがあれば戻す
		$_SESSION = $err;
		header('Location:login_form2.php');
		return;
	}


	// ログイン処理
	$result = UserLogic2::login($post);

	// ログイン失敗時
	if(!$result){
		header('Location:login_form2.php');
		return;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta name="vieport" content="width= device-width,inicia-scale=1.0">
	<title>ログイン完了画面</title>
</head>
<body>
	<h2>ログイン完了</h2>
	<p>ログインしました！</p>
	<a href="mypage2.php">マイページへ</a>

</body>
</html>