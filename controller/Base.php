<?php
require "Template.php";

class Base {
	function __construct(){
		$view = new Template();
		$this->view = $view;
	}

	function render_header($user, $title,$highlight){
		$view = new Template();

		$view->header_catalog_class = "";
		$view->header_your_product_class = "";
		$view->header_add_product_class = "";
		$view->header_sales_class = "";
		$view->header_purchases_class = "";

		$view->header_catalog_link = "./catalog.php?user_id=$user->id";
		$view->header_your_product_link = "./shop.php?action=browse&user_id=$user->id";
		$view->header_add_product_link = "./shop.php?action=add_product&user_id=$user->id";
		$view->header_sales_link = "./sales.php?user_id=$user->id";
		$view->header_purchases_link = "./purchases.php?user_id=$user->id";
		$view->header_logout_link = "./logout.php";

		$view->user = array( "name" => $user->fullname );
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

	function get_user_data($user_id){
		$query = "SELECT * FROM user WHERE id='$user_id';";

		if( $result = $this->db->query($query) ){
			if( $result->num_rows == 1 ){
				$row = $result->fetch_object();
				return $row;
			}
			else {
				return false;
			}
			$result->close();
		}
	}

	function redirect($url){
		header("Location: $url");
	}
}
?>
