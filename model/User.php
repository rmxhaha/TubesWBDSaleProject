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

  static function register($data,$db){
    $query = "
      INSERT INTO user (`fullname`,`username`,`email`,`password`,`address`,`postalcode`,`phonenumber`)
      VALUES ('$data[fullname]','$data[username]','$data[email]','$data[password]','$data[fulladdress]','$data[postcode]','$data[phone]')
    ";
    if( $result = $db->query($query) ){
      return User::with_row($data);
    }
    return false;
  }

  static function authenticate($username_email, $password, $db){
    if( !isset($db) ){
      $m = new Model();
      $m->init_db();
      $db = $m->db;
    }

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

  static function email_available($email,$db){
    if( !isset($db) ){
      $m = new Model();
      $m->init_db();
      $db = $m->db;
    }

    $query= "SELECT COUNT(*) FROM user WHERE email='$email'";
    if( $result = $db->query($query) ){
      $row = $result->fetch_array(MYSQLI_NUM);
      return ($row[0]==0); // email available
    }

    return false;
  }

  static function username_available($username,$db){
    if( !isset($db) ){
      $m = new Model();
      $m->init_db();
      $db = $m->db;
    }

    $query= "SELECT COUNT(*) FROM user WHERE username='$username'";
    if( $result = $db->query($query) ){
      $row = $result->fetch_array(MYSQLI_NUM);
      return ($row[0]==0); // email available
    }

    return false;
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
