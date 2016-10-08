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
    $instance->data = (object) $row;
    $instance->seller = User::with_id($instance->data->seller_id);

    return $instance;
  }

  static function get_by_name($query,$db){
    $query = "
      SELECT product.id FROM product
      WHERE product.name LIKE '%$query%'
      ORDER BY id DESC;
    ";
    $all = array();
    if( $result = $db->query($query) ){
      while($row = $result->fetch_array(MYSQLI_NUM)){
        array_push($all, Product::with_id($row[0]));
      }
    }
    return $all;
  }


  static function get_by_store_name($query,$db){
    $query = "
      SELECT product.id FROM product
      JOIN user
      ON product.seller_id = user.id
      WHERE user.username LIKE '%$query%'
      ORDER BY id DESC;
    ";
    $all = array();
    if( $result = $db->query($query) ){
      while($row = $result->fetch_array(MYSQLI_NUM)){
        array_push($all, Product::with_id($row[0]));
      }
    }
    return $all;
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

  static function get_by_seller($user_id, $db){
    $query = "SELECT id FROM product WHERE seller_id='$user_id' ORDER BY id DESC;";
    $all = array();
    if( $result = $db->query($query) ){
      while($row = $result->fetch_array(MYSQLI_NUM)){
        array_push($all, Product::with_id($row[0]));
      }
    }
    return $all;
  }

  function delete(){
    if( isset( $this->data->id ) ){
      $this->init_db();
      if( $this->db->query("DELETE FROM product WHERE id=".$this->data->id." LIMIT 1;" ) )
        return true;
    }

    return false;
  }

  function save(){
    $this->init_db();
    $product_name = $this->data->name;
    $product_description = $this->data->description;
    $product_price = $this->data->price;
    $product_photo = $this->data->photo;
    $seller_id = $this->data->seller_id;

    $query = "";
    if( isset($this->data->id) ){
      $product_id = $this->data->id;
      // update
      $query = "
        UPDATE product SET
          name='$product_name',
          description='$product_description',
          price='$product_price',
          photo='$product_photo'
        WHERE
          id='$product_id'
        LIMIT 1;";
    }
    else {
      // insert
      $query = "
        INSERT INTO product (`name`,`description`,`price`,`photo`,`seller_id`)
        VALUES ('$product_name','$product_description','$product_price','$product_photo','$seller_id');
      ";
      echo $query;
    }


    if( $result = $this->db->query($query) ){
      return true;
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
      "product_id" => $this->data->id,
			"product_image" => $this->data->photo,
			"product_name" => $this->data->name,
			"product_description" => $this->data->description,
			"product_price" => money_f( $this->data->price ),
			"like_count" => $this->data->likes,
			"purchase_count" => $this->data->purchases,
      "seller_name" => $this->seller->data->username
		  );

    if( $for == "shop" ){
      $option["create_date"] = date_shop_f( $this->data->create_date );

      $view = new Template();
  		foreach($option as $key=>$value){
  			$view->__set($key,$value);
  		}
  		return $view->render_return("shop_product.php");
    }
    else if( $for == "catalog" ){
      $option["create_date"] = date_catalog_f( $this->data->create_date );
      $option["like_button_text"] = $this->data->like_button_text;
      $option["like_button_class"] = $this->data->like_button_class;

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
