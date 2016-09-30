<?php
require "controller/Base.php";

class AccountController extends Base{
	function __construct(){
		Base::__construct();
	}

	function login_form(){
		$this->view->render("login.html");
	}
		
	function login($username, $password){
		$this->init_db();
		$username = $this->db->real_escape_string($username);
		$password = $this->db->real_escape_string($password);
		
		if( $result = $this->db->query("SELECT user_id FROM account WHERE username=$username AND password=$password") ){
			if( $result->num_rows == 1 ){
				$row = $result->fetch_object();
				$this->redirect("./home/?user_id=$row[user_id]");
			}
			else {
				$this->redirect("./login/");
			}
			$result->close();
		}
	}
}

?>
