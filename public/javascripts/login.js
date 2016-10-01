(function(){
	function check_login(username, password){
		if( !username )
			return notify_error("Username must be filled");
		if( !validateUsername(username) && !validateEmail(username) )
			return notify_error("Username is not valid");
		if( !password )
 			return notify_error("Password must be filled");
		
		var data = {
			username : username,
			password : password
		};
		
		request("POST","/api/login", data, function(err, response){
			var result = JSON.parse(response);
			if( !result.result )
				return notify_error("Wrong username or password");
			else
				window.location = result.redirect;
		});
		
		return false;
	}
	
	document.onload = function(){
		
	}
})();
