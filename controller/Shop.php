<?php
require_once "controller/Base.php";
require_once "model/Product.php";

class ShopController extends Base{
	function __construct(){
		Base::__construct();
		$this->init_user();
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

	function product_form_init(){
		$this->view->product_id = "";
		$this->view->product_price = "";
		$this->view->product_name = "";
		$this->view->product_description = "";
		$this->view->errors = "";
		$this->view->action_button_text = "ADD";
		$this->view->form_action = "./shop.php?action=add_product&user_id=".$this->user->data->id;
	}

	function add_product_form(){
		$this->product_form_init();
		$this->view->action_button_text = "ADD";
		$this->view->form_action = "./shop.php?action=add_product&user_id=".$this->user->data->id;
		$this->view->header = $this->render_header("Please add your product here","add_product");
		$this->view->render("shop_add_product.html");
	}

	function get_form_image_errors($name){
		$errors = array();
		$imageFileType = pathinfo(basename($_FILES[$name]["name"]),PATHINFO_EXTENSION);
		if($_FILES[$name]["tmp_name"] && !getimagesize($_FILES[$name]["tmp_name"])) {
			array_push($errors,"File is not an image.");
		}

		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    array_push($errors, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
		}
		return $errors;
	}

	function get_product_errors($required_image){
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

		if( !$required_image ){
			if( $_FILES['product_photo']['name'] != "" )
				$errors = array_merge($errors, $this->get_form_image_errors("product_photo"));
		}
		else {
			$errors = array_merge($errors, $this->get_form_image_errors("product_photo"));
		}
		return $errors;
	}

	function add_product(){
		$product_name = $_POST["product_name"];
		$product_description = $_POST["product_description"];
		$product_price = $_POST["product_price"];
		$errors = $this->get_product_errors(true);
		if( count($errors) == 0 ){
			$target_file = get_image_store_location($_FILES["product_photo"]["name"]);
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
			$this->product_form_init();
			$this->view->action_button_text = "ADD";
			$this->view->form_action = "./shop.php?action=add_product&user_id=".$this->user->data->id;

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
		$this->product_form_init();
		$product_id = $_GET['id'];
		$product = Product::with_id($product_id);

		$this->view->header = $this->render_header("Please update your product here","");
		$this->view->product_id = $product->data->id;
		$this->view->product_price = $product->data->price;
		$this->view->product_name = $product->data->name;
		$this->view->product_description = $product->data->description;
		$this->view->errors = "";
		$this->view->form_action = "./shop.php?action=edit_product&user_id=".$this->user->data->id."&id=".$product_id;
		$this->view->action_button_text = "UPDATE";
		$this->view->render("shop_add_product.html");
	}

	function edit_product(){
		$product_id = $_GET['id'];
		$errors = $this->get_product_errors(false);

		$product_name = $_POST["product_name"];
		$product_description = $_POST["product_description"];
		$product_price = $_POST["product_price"];


		if( count($errors) == 0 ){
			if( $_FILES["product_photo"]["name"] != "" ){
				$target_file = get_image_store_location($_FILES["product_photo"]["name"]);
				if (move_uploaded_file($_FILES["product_photo"]["tmp_name"], $target_file)) {
					$res = Product::with_row(array(
						"id" => $product_id,
						"name" => $product_name,
						"price" => $product_price,
						"description" => $product_description,
						"photo"	 => $target_file,
						"seller_id" => $this->user->data->id
					));
					$res->save();
		    }
			}
			else {
				$product = Product::with_id($product_id);
				$product->data->name = $product_name;
				$product->data->price = $product_price;
				$product->data->description = $product_description;
				$product->save();
			}

			$this->redirect("./shop.php?action=browse&user_id=".$this->user->data->id );
		}
		else {
			$this->product_form_init();
			$this->view->form_action = "./shop.php?action=edit_product&user_id=".$this->user->data->id."&id=".$product_id;
			$this->view->action_button_text = "UPDATE";

			$errors_str = "";
			foreach($errors as $err){
			 $errors_str .= "<span class=error>$err</span>";
			}

			$this->view->product_id = $product_id;
			$this->view->product_name = $product_name;
			$this->view->product_price = $product_price;
			$this->view->product_description = $product_description;

			$this->view->header = $this->render_header("Please update your product here","");
			$this->view->errors = $errors_str;
			$this->view->form_action = "./shop.php?action=edit_product&user_id=".$this->user->data->id."&id=".$product_id;
			$this->view->render("shop_add_product.html");

		}
	}

}
?>
