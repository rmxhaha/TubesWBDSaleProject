<?php
require "Template.php";

class Base {
	function __construct(){
		$view = new Template();
		$this->view = $view;
	}

	function render_header($username, $title,$highlight){
		$view = new Template();

		$view->header_catalog_class = "";
		$view->header_your_product_class = "";
		$view->header_add_product_class = "";
		$view->header_sales_class = "";
		$view->header_purchases_class = "";

		$view->user = array( "name" => $username );
		$view->title = $title;

		$view->__set("header_".$highlight."_class","header_highlight");

		return $view->render_return("header.php");
	}

	function init_db(){
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if( $mysqli->connect_errno ){
			throw new Exception("Cannot connect to database");
		}
		$this->db = $mysqli;
	}

	function redirect($url){
		header("Location: $url");
	}
}
?>
