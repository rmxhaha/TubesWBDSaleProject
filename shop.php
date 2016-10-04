<?php
require "controller/Shop.php";

if( $_GET['action'] == "browse" ){
  $shop = new ShopController();
  $shop->your_products_page();
}
else if( $_GET['action'] == "add_product" ){
  $shop = new ShopController();
  $shop->add_product_form();
}

?>
