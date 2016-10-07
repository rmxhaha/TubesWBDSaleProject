<?php
require_once "controller/Transaction.php";

$trans = new TransactionController();
$trans->purchase_history();
?>
