<?php
require_once "model/Model.php";

function money_f($p){
  $remainder = intval($p / 1000);
  if( $remainder == 0 ){
    return "IDR $p";
  }
  else
    return money_f( $remainder ).",".( intval($p % 1000) );
}


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
    $instance->data = (object) $row;
    $instance->seller = User::with_id($instance->data->seller_id);

    return $instance;
  }

  static function get_all($db){
    $query = "SELECT id FROM product ORDER BY id DESC;";
    $all = array();
    if( $result = $db->query($query) ){
      while($row = $result->fetch_array(MYSQLI_NUM)){
        array_push($all, Product::with_id($row[0]));
      }
    }
    return $all;
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

    $result = $this->db->query($query);
    if( $result->num_rows == 1 ){
      $row = $result->fetch_object();
      $this->data = $row;
    }
    else {
      throw new Exception("Unknown product id");
    }
    $result->free();

    $query = "SELECT COUNT(*) FROM product_like WHERE product_id = '$id';";
    if( $result = $this->db->query($query) ){
      $row = $result->fetch_array(MYSQLI_NUM);
      $this->data->likes = $row[0];
      $result->free();
    }

    $query = "SELECT COUNT(*) FROM purchase WHERE product_id = '$id';";

    if( $result = $this->db->query($query) ){
      $row = $result->fetch_array(MYSQLI_NUM);
      $this->data->purchases = $row[0];
      $result->free();
    }
  }

  function render($for = "shop"){
    $option = array(
			"create_date" => "30 February 2016",
			"product_image" => $this->data->photo,
			"product_name" => $this->data->name,
			"product_description" => $this->data->description,
			"product_price" => money_f( $this->data->price ),
			"like_count" => $this->data->likes,
			"purchase_count" => $this->data->purchases,
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
