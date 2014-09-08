<?php
if (! $_GET ['type']) {
	echo "var sid='{$_COOKIE['PHPSESSID']}'";
} else {
	if (isset ( $_REQUEST ['PHPSESSID'] )) {
		session_destroy ();
		session_id ( $_REQUEST ['PHPSESSID'] );
	}
	
	// 初始化Session
	session_start ();
	echo json_encode ( $_SESSION ['userInfo'] );
}