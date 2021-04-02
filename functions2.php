<?php 

/**
 * XSS対策　エスケープ処理
 * @param string $str 対象の文字列
 * @return string 処理された文字列
 */
function h ($str){
	return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}

/**
 * XSS対策　サニタイズ処理
 * @param array $arr 対象の配列
 * @return array 処理された配列
 */
function sanitize ($arr){
	return filter_input_array($arr,FILTER_SANITIZE_STRING);

}



/**
 * csrf対策
 * @param void
 * @return string $csrf_token
 */
function setToken(){
	//32バイトのランダム文字列を生成→16進数に変換したASCII列に変換。
	$csrf_token = bin2hex(random_bytes(32));
	$_SESSION['csrf_token'] = $csrf_token ;
 	return $csrf_token;

}

?>