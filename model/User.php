<?php
require_once "model/Model.php";

class User extends Model {
  function __construct($user_id){
		Model::__construct();
		$this->init($user_id);
	}

  function init($user_id){
    $this->init_db();
    $query = "SELECT * FROM user WHERE id='$user_id';";

    if( $result = $this->db->query($query) ){
      if( $result->num_rows == 1 ){
        $row = $result->fetch_object();
        $this->data = $row;
      }
      else {
        throw new Exception("Unknown user id");
      }
      $result->close();
    }
  }
}
?>
