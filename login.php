<?php
require_once "controller/Account.php";

if( $_SERVER['REQUEST_METHOD'] == "GET" ){
	$account = new AccountController();
	$account->login_form();
}
else if( $_SERVER['REQUEST_METHOD'] == "POST" ){
	$account = new AccountController();
	$account->login();
}

?>
