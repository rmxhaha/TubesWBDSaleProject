<?php
require "Template.php";

class Base {
	function __construct(){
		$this->view = new Template();
	}
	
	function init_db(){
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if( $mysqli->connect_errno ){
			throw new Exception("Cannot connect to database");
		}
		$this->db = $mysql;
	}
	
	function redirect($url){
		header("Location: $url");
	}
}
?>
