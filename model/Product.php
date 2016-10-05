<?php
require_once "model/Model.php";

class Product extends Model{
  function __construct(){
    Model::__construct();
  }

  static function with_id($product_id){
    $instance = new self();
    $instance->init_by_id($product_id);
    $instance->seller = User::with_id($instance->data->seller_id);

    return $instance;
  }

  static function with_row($row){
    $instance = new self();
    $instance->data = $row;
    $instance->seller = User::with_id($row->seller_id);

    return $instance;
  }

  static function register($data,$db){
    if( !isset($db) ){
      $m = new Model();
      $m->init_db();
      $db = $m->db;
    }

    $query = "
      INSERT INTO product (`name`,`description`,`price`,`photo`,`seller_id`)
      VALUES ('$data[product_name]','$data[product_description]','$data[product_price]','$data[product_photo]','$data[seller_id]');
    ";

    if( $result = $db->query($query) ){
      return Product::with_row($data);
    }
    return false;
  }

  function init_by_id($id){
    $this->init_db();
    $query = "SELECT * FROM product WHERE id='$id';";

    if( $result = $this->db->query($query) ){
      if( $result->num_rows == 1 ){
        $row = $result->fetch_object();
        $this->data = $row;
      }
      else {
        throw new Exception("Unknown product id");
      }
      $result->close();
    }
  }

  function render($for = "shop"){
    function money_f($p){
      $remainder = intval($p / 1000);
      if( $remainder == 0 ){
        return "IDR $p";
      }
      else
        return money_f( $remainder ).",".( intval($p % 1000) );

    }
    $option = array(
			"create_date" => "30 February 2016",
			"product_image" => $this->data->photo,
			"product_name" => $this->data->name,
			"product_description" => $this->data->description,
			"product_price" => money_f( $this->data->price ),
			"like_count" => "7",
			"purchase_count" => "3",
      "seller_name" => $this->seller->data->fullname
		);

    if( $for == "shop" ){
      $view = new Template();
  		foreach($option as $key=>$value){
  			$view->__set($key,$value);
  		}
  		return $view->render_return("shop_product.php");
    }
    else if( $for == "catalog" ){
      $view = new Template();
  		foreach($option as $key=>$value){
  			$view->__set($key,$value);
  		}
      return $view->render_return("catalog_product.php");
    }
    else
      return "";
  }

}

?>
