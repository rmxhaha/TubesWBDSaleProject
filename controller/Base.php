<?php
require_once "model/Template.php";
require_once "model/User.php";

class Base {
	function __construct(){
		$view = new Template();
		$this->view = $view;
	}

	function render_header($title,$highlight){
		$user = $this->user->data;
		$view = new Template();

		$view->header_catalog_class = "";
		$view->header_your_product_class = "";
		$view->header_add_product_class = "";
		$view->header_sales_class = "";
		$view->header_purchases_class = "";

		$view->header_catalog_link = "./home.php?user_id=$user->id";
		$view->header_your_product_link = "./shop.php?action=browse&user_id=$user->id";
		$view->header_add_product_link = "./shop.php?action=add_product&user_id=$user->id";
		$view->header_sales_link = "./shop.php?action=sales&user_id=$user->id";
		$view->header_purchases_link = "./purchases.php?user_id=$user->id";
		$view->header_logout_link = "./logout.php";

		$view->user = array( "name" => $user->fullname );
		$view->title = $title;

		$view->__set("header_".$highlight."_class","header_highlight");

		return $view->render_return("header.php");
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

	function init_user(){
		$user_id = $_GET['user_id'];
		if( empty($user_id) )
			return $this->redirect("./");

		$user_id = $_GET['user_id'];
		$this->init_db();

		$this->user = User::with_id($user_id);
	}

	function redirect($url){
		header("Location: $url");
	}
}
?>
