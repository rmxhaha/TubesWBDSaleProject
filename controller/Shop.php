<?php
require_once "controller/Base.php";
require_once "model/Product.php";

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
		$products = Product::get_by_seller($this->user->data->id, $this->db);
		$product_str = "";
		foreach( $products as $product ){
			$product_str .= $product->render("shop");
		}

		$this->view->products = $product_str;

		$this->view->render("shop_browse.php");
	}

	function get_products_by_user_id($user_id){

	}

	function add_product_form_init(){
		$this->view->product_price = "";
		$this->view->product_name = "";
		$this->view->product_description = "";
		$this->view->errors = "";
		$this->view->add_product_action = "./shop.php?action=add_product&user_id=".$this->user->data->id;
	}

	function add_product_form(){
		$this->add_product_form_init();
		$this->view->header = $this->render_header("Please add your product here","your_product");
		$this->view->render("shop_add_product.html");
	}

	static function generate_random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}

	function add_product(){
		$imageFileType = pathinfo(basename($_FILES["product_photo"]["name"]),PATHINFO_EXTENSION);
		$errors = array();

		$product_name = $_POST["product_name"];
		$product_description = $_POST["product_description"];
		$product_price = $_POST["product_price"];

		if (!preg_match("/^[0-9]*$/",$product_price) || strlen($product_price) < 1 ) {
			array_push($errors, "Product price must be a positive number");
		}

		if (!preg_match("/^[a-zA-Z ]*$/",$product_name) || strlen($product_name) < 1 ) {
			array_push($errors, "Product Name only allow letters and white space");
		}

		$target_file = IMAGE_UPLOAD_DIR . ShopController::generate_random_string().".$imageFileType";
		if($_FILES["product_photo"]["tmp_name"] && !getimagesize($_FILES["product_photo"]["tmp_name"])) {
			array_push($errors,"File is not an image.");
    }

		if (file_exists($target_file)) {
			unlink($target_file);
		}

		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
		}

		if( count($errors) == 0 ){
			if (move_uploaded_file($_FILES["product_photo"]["tmp_name"], $target_file)) {
				$res = Product::with_row(array(
					"name" => $product_name,
					"price" => $product_price,
					"description" => $product_description,
					"photo"	 => $target_file,
					"seller_id" => $this->user->data->id
				));
				$res->save();
				$this->redirect("./shop.php?action=browse&user_id=".$this->user->data->id );
	    }
		}
		else {
			$this->add_product_form_init();

			$errors_str = "";
			foreach($errors as $err){
			 $errors_str .= "<span class=error>$err</span>";
			}

			$this->view->product_name = $product_name;
			$this->view->product_price = $product_price;
			$this->view->product_description = $product_description;

			$this->view->header = $this->render_header("Please add your product here","your_product");
			$this->view->errors = $errors_str;
			$this->view->render("shop_add_product.html");
		}
	}

	function delete_product(){
		$product_id = $_GET['id'];
		$product = Product::with_id($product_id);

		if( $product->data->seller_id == $_GET['user_id'] ){
			$product->delete();
		}
	}

	function edit_product_form(){

	}

	function edit_product(){

	}
}
?>
