<?php
require_once "model/Model.php";
require_once "model/User.php";
require_once "model/Product.php";

class Transaction extends Model {
  function __construct(){
		Model::__construct();
	}

  static function with_id($user_id){
    $instance = new self();
    $instance->init_by_id($user_id);

    return $instance;
  }

  static function get_by_seller($seller_id,$db){
    $query = "SELECT purchase_id FROM purchase WHERE seller_id='$seller_id' ORDER BY purchase_id DESC;";
    $all = array();
    if( $result = $db->query($query) ){
      while($row = $result->fetch_array(MYSQLI_NUM)){
        array_push($all, Transaction::with_id($row[0]));
      }
    }
    return $all;
  }

  static function get_by_buyer($buyer_id,$db){
    $query = "SELECT purchase_id FROM purchase WHERE buyer_id='$buyer_id' ORDER BY purchase_id DESC;";
    $all = array();
    if( $result = $db->query($query) ){
      while($row = $result->fetch_array(MYSQLI_NUM)){
        array_push($all, Transaction::with_id($row[0]));
      }
    }
    return $all;
  }

  static function create($option){
    $m = new Model();
    $m->init_db();
    $db = $m->db;
    $buyer_id = $option["buyer"]->data->id;

    // for snapshoting
    $product_id = $option["product"]->data->id;
    $product_name = $option["product"]->data->name;
    $product_price = $option["product"]->data->price;
    $product_photo = get_image_store_location($option["product"]->data->photo);

    copy($option["product"]->data->photo, $product_photo);

    $seller_id = $option["product"]->data->seller_id;

    $query = "
      INSERT INTO purchase (
        `consignee`,`address`,`postcode`,`phone`,`credit_card_number`,`quantity`,
        `seller_id`,`buyer_id`,
        `product_id`,`product_name`,`product_price`,`product_photo`
        )
      VALUES (
        '$option[consignee]','$option[address]','$option[postcode]','$option[phone]','$option[credit_card_number]','$option[quantity]',
        '$seller_id','$buyer_id',
        '$product_id','$product_name','$product_price','$product_photo'
      );
    ";
    $db->query($query);

    return Transaction::with_id($db->insert_id);
  }

  static function with_row($row){
    $instance = new self();
    $instance->data = (object) $row;

    return $instance;
  }


  function init_by_id($id){
    $this->init_db();
    $query = "SELECT * FROM purchase WHERE purchase_id='$id';";

    if( $result = $this->db->query($query) ){
      if( $result->num_rows == 1 ){
        $row = $result->fetch_object();
        $this->data = $row;
        $this->seller = User::with_id($row->seller_id);
        $this->buyer = User::with_id($row->buyer_id);
        $this->product = Product::with_row(array(
          "id" => $row->product_id,
          "name" => $row->product_name,
          "photo" => $row->product_photo,
          "price" => $row->product_price,
          "seller_id" => $row->seller_id
        ));
      }
      else {
        throw new Exception("Unknown purchase id");
      }
      $result->close();
    }
  }

  function render($for){
    $option = array(
      "create_date" => date_shop_f($this->data->purchasetime),
      "product_image" => $this->product->data->photo,
      "product_name" => $this->product->data->name,
      "product_price" => money_f($this->product->data->price),
      "quantity" => $this->data->quantity,
      "total_price" => money_f($this->product->data->price * $this->data->quantity),
      "seller_username" => $this->seller->data->username,
      "consignee" => $this->data->consignee,
      "address" => $this->data->address,
      "postcode" => $this->data->postcode,
      "phone" => $this->data->phone
    );
    if( $for == "purchase" ){
      $seller_username = $this->seller->data->username;
      $option["meta_subject"] = "bought from <b>$seller_username</b>";
    }
    else if( $for == "sales" ){
      $buyer_username = $this->buyer->data->username;
      $option["meta_subject"] = "bought by <b>$buyer_username</b>";
    }

    $view = new Template();
		foreach($option as $key=>$value){
			$view->__set($key,$value);
		}
		return $view->render_return("transaction.php");
  }



}

?>
