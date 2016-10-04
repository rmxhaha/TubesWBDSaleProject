<?php
require "controller/Base.php";

class CatalogController extends Base{
	function __construct(){
		Base::__construct();
	}

	function render_catalog_product($option){
		$view = new Template();
		foreach($option as $key=>$value){
			$view->__set($key,$value);
		}
		return $view->render_return("catalog_product.php");
	}

	function catalog(){
		$user_id = $_GET['user_id'];
		if( empty($user_id) )
			return $this->redirect("./");

		$this->init_db();
		$user_data = $this->get_user_data($user_id);

		$products = "";
		$this->view->header = $this->render_header($user_data,"What are you going to buy today?","catalog");
		$this->view->products = $this->render_catalog_product(array(
			"seller_name" => "sample_seller",
			"create_date" => "30 February 2016",
			"product_image" => "./public/images/sample.png",
			"product_name" => "Poster",
			"product_description" => "sample product desc, Ukuran 20x20",
			"product_price" => "IDR 135,000",
			"like_count" => "7",
			"purchase_count" => "3"
		));
		$this->view->render("catalog.php");

		$this->db->close();
	}
}
?>
