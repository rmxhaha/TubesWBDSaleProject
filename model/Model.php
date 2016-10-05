<?php
require_once "model/Template.php";

class Model {
	function __construct(){
		$view = new Template();
		$this->view = $view;
	}

	function init_db(){
		if( isset($this->db) )
			return;

		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if( $mysqli->connect_errno ){
			throw new Exception("Cannot connect to database");
		}
		$this->db = $mysqli;
	}
}
?>
