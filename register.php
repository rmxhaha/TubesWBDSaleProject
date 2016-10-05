<?php
error_reporting(E_ALL);
require_once "controller/Account.php";

if( $_SERVER['REQUEST_METHOD'] == "GET" ){
	$account = new AccountController();
	$account->register_form();
}
else if( $_SERVER['REQUEST_METHOD'] == "POST" ){
	$account = new AccountController();
	$account->register();
}

?>
