<?php
require_once "controller/Base.php";
require_once "model/Product.php";

class CatalogController extends Base{
	function __construct(){
		Base::__construct();
		$this->init_user();
	}

	function catalog(){
		$products = "";
		$this->view->header = $this->render_header("What are you going to buy today?","catalog");
		$products = Product::get_all($this->db);
		$product_str = "";
		foreach( $products as $product ){
			if( $this->user->liked($product) ){
				$product->data->like_button_text = "UNLIKE";
			}
			else {
				$product->data->like_button_text = "LIKE";
			}

			$product_str .= $product->render("catalog");
		}

		$this->view->products = $product_str;
		$this->view->render("catalog.php");

		$this->db->close();
	}

	function like(){
		$product_id = $_GET['id'];

		$product = Product::with_id($product_id);
		$this->user->like($product);
	}
}
?>
