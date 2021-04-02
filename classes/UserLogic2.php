<?php 


require_once ( __DIR__ . '/../dbconnect2.php');

Class UserLogic2 
{

	/**
	 * ユーザーを登録する
	 * @param array $userData
	 * @return bool $result
	 */

	public static function createUser ($userData){

		$sql = "INSERT INTO users2 (name,email,password) VALUES (?,?,?)";


		$result = false;

		$arr = array();
		$arr[] = $userData['username'];
		$arr[] = $userData['mail'];
		$arr[] = password_hash($userData['password'],PASSWORD_DEFAULT);


		try{
			$dbh = dbConnect();
			$stmt = $dbh->prepare($sql);
			$result = $stmt->execute($arr);
			return $result;
		}catch(Exception $e){
			echo $e->getMessage();
			return $result;
		}
	


	}

		/**
	 * emailからユーザーを取得
	 * @param array $loginData
	 * @return array|bool $user|false
	 */

	protected static function getUserByemail ($loginData){


		$arr  = array();
		$arr[] = $loginData['mail'];

		try{
			$dbh = dbconnect();
			$sql = "SELECT* FROM users2 WHERE email = ?";
			$stmt = $dbh->prepare($sql);
			$stmt->execute($arr);
			$user = $stmt->fetch();
			return $user;

			// ネームスペース内でキャッチする場合は\が必要
		}catch(\Exception $e){
			return false;
		}
	}


	/**
	 * ログイン処理
	 * @param array $loginData
	 * @return bool $result
	 */

	public static function login ($loginData){

		$result = false;


		$user = self::getUserByemail($loginData);

		//ユーザーが存在するかどうか
		if(!$user){
			$_SESSION['msg'] = 'emailが一致しません';
			return $result;
		}

		//パスワードの照合
		if(password_verify($loginData['password'], $user['password'])){
			session_regenerate_id(true);
			$_SESSION['login_user'] = $user;
			$result = true;
			return $result;
		}else{
			$_SESSION['msg'] = 'パスワードが一致しません。';
			return $result;
		}

	}

	/**
	 * ログインチェック
	 * @param 
	 * @return bool $result
	 */
	public static function checkLogin (){

		$result = false;

		// セッションにログインユーザーが入っているかどうか
		if(isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] >0 ){
			return $result = true;
		}else{
			return $result;
		}

	}
	/**
	 * ログアウト
	 * @param void
	 */
	public static function logout(){
		$_SESSION = array();
		session_destroy();
}

	


}
	


?>