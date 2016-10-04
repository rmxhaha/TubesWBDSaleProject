<?php
require "controller/Base.php";

class ShopController extends Base{
	function __construct(){
		Base::__construct();
		$this->init_user();
	}

	function render_shop_product($option){
		$view = new Template();
		foreach($option as $key=>$value){
			$view->__set($key,$value);
		}
		return $view->render_return("shop_product.php");
	}

	function your_products_page(){
		$this->view->header = $this->render_header("What are you going to sell today?","your_product");
		$this->view->products = $this->render_shop_product(array(
			"create_date" => "30 February 2016",
			"product_image" => "./public/images/sample.png",
			"product_name" => "Poster",
			"product_description" => "sample product desc, Ukuran 20x20",
			"product_price" => "IDR 135,000",
			"like_count" => "7",
			"purchase_count" => "3"
		));

		$this->view->render("shop_browse.php");
	}

	function get_products_by_user_id($user_id){

	}

	function add_product_form_init(){
		$this->view->product_price = "";
		$this->view->product_name = "";
		$this->view->product_description = "";
	}

	function add_product_form(){
		$this->add_product_form_init();
		$this->view->header = $this->render_header("Please add your product here","your_product");
		$this->view->render("shop_add_product.html");
	}

	function add_product(){

	}

	function delete_product(){

	}

	function edit_product_form(){

	}

	function edit_product(){

	}
}
?>
