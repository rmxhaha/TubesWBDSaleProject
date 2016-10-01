<?php
require "controller/Base.php";

class AccountController extends Base{
	function __construct(){
		Base::__construct();
	}

	function login_form(){
		$this->view->render("login.html");
	}
	
	function header(){
		$this->render_header("Yes","random","catalog");
	}
	
	function login(){
		$this->init_db();
		$username = $_POST["username"];
		$password = $_POST["password"];		
		$username = $this->db->real_escape_string($username);
		$password = $this->db->real_escape_string($password);
		
		$query = "SELECT id FROM user WHERE (username='$username' OR email='$username') AND password='$password';";
		
		if( $result = $this->db->query($query) ){
			if( $result->num_rows == 1 ){
				$row = $result->fetch_object();
				$this->redirect("/home.php?user_id=$row[id]");
			}
			else {
				$this->redirect("/login.php");
			}
			$result->close();
		}
	}
	
	function register_form(){
		$this->view->nameErr = "";
		$this->view->usernameError = "";
		$this->view->passError = "";
		$this->view->emailErr = "";
		
		$this->view->render("register.html");
	}
	
	function register(){
		
	}
}

?>
