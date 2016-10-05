<?php
require_once "controller/Base.php";

class TransactionController extends Base{
	function __construct(){
		Base::__construct();
		$this->init_user();
	}

	function purchase_form(){
		// render purchase form
	}

	function purchase(){
		// handle validation and submission
	}

	function get_purchase_history($option){
		// get from db
	}

	function purchase_history(){
		// render page for buyer
	}

	function sales_history(){
		// render page for seller
	}
}
?>
