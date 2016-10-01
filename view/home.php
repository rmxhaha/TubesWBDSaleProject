<?=$this->test_var?>


<?
var_dump($this);
ob_start();
require "test2.php"
ob_flush();
?>
