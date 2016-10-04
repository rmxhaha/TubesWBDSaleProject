<?php
require "controller/Shop.php";

if( $_GET['action'] == "browse" ){
  $shop = new ShopController();
  $shop->your_products_page();
}

?>
