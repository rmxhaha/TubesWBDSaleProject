<?php
require_once "controller/Shop.php";
require_once "controller/Transaction.php";

if( $_GET['action'] == "browse" ){
  $shop = new ShopController();
  $shop->your_products_page();
}
else if( $_GET['action'] == "add_product" ){
  if( $_SERVER['REQUEST_METHOD'] == "GET" ){
    $shop = new ShopController();
    $shop->add_product_form();
  }
  else if( $_SERVER['REQUEST_METHOD'] == "POST" ){
    $shop = new ShopController();
    $shop->add_product();
  }
}
else if( $_GET['action'] == "edit_product" ){
  if( $_SERVER['REQUEST_METHOD'] == "GET" ){
    $shop = new ShopController();
    $shop->edit_product_form();
  }
  else if( $_SERVER['REQUEST_METHOD'] == "POST" ){
    $shop = new ShopController();
    $shop->edit_product();
  }
}
else if( $_GET['action'] == "buy_product" ){
  if( $_SERVER['REQUEST_METHOD'] == "GET" ){
    $shop = new TransactionController();
    $shop->purchase_form();
  }
  else if( $_SERVER['REQUEST_METHOD'] == "POST" ){
    $shop = new TransactionController();
    $shop->purchase();
  }
}
else if( $_GET['action'] == "delete_product" ){
  $shop = new ShopController();
  $shop->delete_product();
}

?>
