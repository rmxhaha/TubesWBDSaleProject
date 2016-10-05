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
		$prod = Product::with_id(1);

		$this->view->products = $prod->render("catalog");
		$this->view->render("catalog.php");

		$this->db->close();
	}
}
?>
