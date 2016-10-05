<?php
require_once "model/Model.php";

class User extends Model {
  function __construct(){
		Model::__construct();
	}

  static function with_id($user_id){
    $instance = new self();
    $instance->init_by_id($user_id);

    return $instance;
  }

  static function with_row($row){
    $instance = new self();
    $instance->data = $row;

    return $instance;
  }

  static function authenticate($username_email, $password){
    $m = new Model();
    $m->init_db();
    $db = $m->db;

    $username = $db->real_escape_string($username_email);
		$password = $db->real_escape_string($password);
    $query = "SELECT id FROM user WHERE (username='$username' OR email='$username') AND password='$password';";
    if( $result = $db->query($query) ){
      $answer = 0;
      if( $result->num_rows == 1 ){
        $row = $result->fetch_object();
        $answer = $row->id;
      }

      $result->close();
      return $answer;
    }

  }

  function init_by_id($user_id){
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
