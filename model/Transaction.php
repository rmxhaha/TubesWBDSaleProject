<?php
require_once "model/Model.php";

class Transaction extends Model {
  function __construct(){
		Model::__construct();
	}

  static function with_id($user_id){
    $instance = new self();
    $instance->init_by_id($user_id);

    return $instance;
  }

  static function create($option){
    $m = new Model();
    $m->init_db();
    $db = $m->db;
    $buyer_id = $option["buyer"]->data->id;
    $product_id = $option["product"]->data->id;
    $seller_id = $option["product"]->data->seller_id;

    $query = "
      INSERT INTO purchase (`consignee`,`address`,`postcode`,`phone`,`credit_card_number`,`quantity`,`product_id`,`seller_id`,`buyer_id`)
      VALUES ('$option[consignee]','$option[address]','$option[postcode]','$option[phone]','$option[credit_card_number]','$option[quantity]','$product_id','$seller_id','$buyer_id');
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
      }
      else {
        throw new Exception("Unknown purchase id");
      }
      $result->close();
    }
  }



}

?>
