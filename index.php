<?php
error_reporting(E_ALL);
require "controller/Account.php";


$account = new AccountController();
$account->login_form();
?>
