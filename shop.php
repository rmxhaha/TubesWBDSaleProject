<?php
require_once "controller/Shop.php";

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
else if( $_GET['action'] == "delete_product" ){
  $shop = new ShopController();
  $shop->delete_product();
}

?>
