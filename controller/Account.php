<?php
require_once "controller/Base.php";
require_once "model/User.php";

class AccountController extends Base{
	function __construct(){
		Base::__construct();
	}

	function login_form(){
		$this->view->render("login.html");
	}

	function login(){
		$this->init_db();
		$username = $_POST["username"];
		$password = $_POST["password"];
		$user_id = User::authenticate($username, $password);

		if( !$user_id ){
			$this->redirect("./login.php");
		}
		else {
			$this->redirect("./home.php?user_id=$user_id");
		}
	}

	function register_form_init(){
		// empty all
		$this->view->name = "";
		$this->view->username = "";
		$this->view->password = "";
		$this->view->email = "";
		$this->view->address = "";
		$this->view->postcode = "";
		$this->view->phone = "";

		$this->view->nameErr = "";
		$this->view->usernameError = "";
		$this->view->passwordError = "";
		$this->view->emailError = "";
		$this->view->addressError = "";
		$this->view->postcodeError = "";
		$this->view->phoneError = "";
	}

	function register_form(){
		$this->register_form_init();
		$this->view->render("register.html");
	}

	function register(){
		$fullname = $_POST["fullname"];
		$username = $_POST["username"];
		$email = $_POST["email"];
		$password= $_POST["password"];
		$confirmpassword = $_POST["confirmpassword"];
		$fulladdress = $_POST["fulladdress"];
		$postcode = $_POST["postcode"];
		$phone = $_POST["phone"];

		$nameErr = "";
		$usernameErr = "";
		$emailErr = "";
		$passError = "";
		$phoneError = "";
		$postcodeError = "";

		//Checking
		if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) {
			$nameErr = "Only letters and white space allowed";
		}
		if (!preg_match("/^[a-zA-Z]*$/",$username)) {
			$usernameErr = "Only letters allowed";
		}

		if (!preg_match("/^[0-9]*$/",$postcode) || strlen($postcode) != 5 ) {
			$postcodeError = "Only 5 digits numbers allowed";
		}

		if (!preg_match("/^[0-9]*$/",$phone) || strlen($phone) < 6 || strlen($phone) > 15 ) {
			$phoneError = "Only 6 to 15 digits numbers allowed";
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
		}
		if(strlen($password) < 6){
			$passError = "Password is too short";
		}

		if($password != $confirmpassword ){
			$passError = "Password didn't match";
		}

		$this->init_db();

		//SQL execute
		if( empty($emailErr) ){
			if( !User::email_available($email,$this->db) ){
				$emailErr = "Email has already been used";
			}
		}

		if( empty($usernameErr) ){
			if( !User::username_available($username,$this->db) ){
				$usernameErr = "Username has already been used";
			}
		}


		if( empty($nameErr) && empty($usernameErr) && empty($emailErr) && empty($passError) && empty($postcodeError) && empty($phoneError)){
			$data = array(
				"fullname" => $fullname,
				"username" => $username,
				"email" => $email,
				"password" => $password,
				"fulladdress" => $fulladdress,
				"postcode" => $postcode,
				"phone" => $phone
			);
			if( User::register($data,$this->db) ){
				$this->redirect("login.php");
			}
		}
		else {
			$this->register_form_init();
			$this->view->name = $fullname;
			$this->view->username = $username;
			$this->view->email = $email;
			$this->view->address = $fulladdress;
			$this->view->postcode = $postcode;
			$this->view->phone = $phone;

			$this->view->nameErr = $nameErr;
			$this->view->usernameError = $usernameErr;
			$this->view->passwordError = $passError;
			$this->view->emailError = $emailErr;
			$this->view->phoneError = $phoneError;
			$this->view->postcodeError = $postcodeError;

			$this->view->render("register.html");
		}

		$this->db->close();

	}
}

?>
