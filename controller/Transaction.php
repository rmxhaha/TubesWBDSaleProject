<?php
require_once "controller/Base.php";
require_once "model/Transaction.php";

class TransactionController extends Base{
	function __construct(){
		Base::__construct();
		$this->init_user();
	}

	function purchase_form(){
		$product_id = $_GET['id'];
		$product = Product::with_id($product_id);

		$this->view->header = $this->render_header("Please confirm your purchase","");
		$this->view->product_id = $product->data->id;
		$this->view->product_price = money_f( $product->data->price );
		$this->view->product_price_raw = $product->data->price;
		$this->view->product_name = $product->data->name;
		$this->view->consignee = $this->user->data->fullname;
		$this->view->phone = $this->user->data->phonenumber;
		$this->view->postcode = $this->user->data->postalcode;
		$this->view->fulladdress = $this->user->data->address;
		$this->view->credit_card_number = "";
		$this->view->credit_card_verification = "";
		$this->view->errors = "";
		$this->view->form_action = "./shop.php?action=buy_product&user_id=".$this->user->data->id."&id=".$product_id;

		$this->view->errors = "";
		$this->view->render("shop_purchase_form.html");
	}

	function purchase(){
		$product_id = $_GET['id'];
		$product = Product::with_id($product_id);
		Transaction::create(array(
			"product" => $product,
			"buyer" => $this->user,
			"quantity" => $_POST["quantity"],
			"consignee" => $_POST["consignee"],
			"postcode" => $_POST['postcode'],
			"phone" => $_POST["phone"],
			"address" => $_POST["fulladdress"],
			"credit_card_number" => $_POST["credit_card_number"]
		));

		$this->redirect("./purchases.php?user_id=".$this->user->data->id);
	}

	function purchase_history(){
		// render page for buyer
		$transactions = Transaction::get_by_buyer($this->user->data->id,$this->db);
		$transaction_str = "";

		foreach( $transactions as $t ){
			$transaction_str .= $t->render();
		}

		$this->view->header = $this->render_header("Here are your purchases","purchases");
		$this->view->transactions = $transaction_str;

		$this->view->render("purchase_history.php");
	}

	function sales_history(){
		// render page for seller
		$transactions = Transaction::get_by_seller($this->user->data->id,$this->db);
		$transaction_str = "";

		foreach( $transactions as $t ){
			$transaction_str .= $t->render();
		}

		$this->view->header = $this->render_header("Here are your sales","sales");
		$this->view->transactions = $transaction_str;

		$this->view->render("purchase_history.php");	}
}
?>
