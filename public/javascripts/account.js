

function validate_register(){
	function get(x){
		return document.getElementsByName(x)[0].value;
	}
	var fullname = get("fullname");
	var username = get("username");
	var email = get("email");
	var password = get("password");
	var confirmpassword = get("confirmpassword");
	var fulladdress = get("fulladdress");
	var postcode = get("postcode");
	var phone = get("phone");

	var errors = [];

	function check(v, msg){
		if(!v)
			errors.push(msg);
	}



	check( fullname.length > 1 && validateName(fullname),"Name must be characters and space only" );

	check( username.length > 1 && validateUsername(username), "Username must be characters only");

	check( validatePositiveNumber(postcode) && postcode.length == 5, "Postcode must be 5 digits number");

	check( validatePositiveNumber(phone) && 6 <= phone.length && phone.length <= 15, "Only 6 to 15 digits phone number allowed" );

	check( validateEmail(email), "Email is not valid" );

	check( password.length >= 6, "Password is too short" );

	check( password == confirmpassword, "Password didn't match");

	check( validatePositiveNumber(postcode) && postcode.length == 5, "Postcode must be 5 digits number");

	show_error(errors);

	return errors.length == 0;
}
