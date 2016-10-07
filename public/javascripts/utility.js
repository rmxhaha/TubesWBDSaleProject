function notify_error(x){
	alert(x);
	return false;
}

function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}

function validateUsername(username){
	var nameRegex = /^[a-zA-Z\-]+$/;
	return nameRegex.test(username);
}

function validateName(username){
	var nameRegex = /^[a-zA-Z \-]+$/;
	return nameRegex.test(username);
}
function validatePositiveNumber(n){
	var n = parseInt(n);
	if( isNaN(n) ) return false;

	return n > 0;
}

function show_error(errors){
  var errors_container = document.getElementsByClassName("error-container")[0];
  errors_container.innerHTML = "";

  for( var i in errors ){
    var d = document.createElement("div");
    d.setAttribute("class","error");
    d.innerHTML = errors[i];
    errors_container.appendChild(d);
  }
}


function request(method,uri,data,callback){
	function serialize(data){
		var arr = [];
		for( var key in data ){
			arr.push( key + "=" + data[key] );
		}

		return arr.join("&");
	}

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 ) {
			if( this.status == 200 ){
				return callback(null,this.responseText);
			}
			else {
				return callback(true);
			}
		}
	};

	if( method == "POST"){
		xhttp.open(method, uri, true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send(serialize(data));
	}
	else {
		if( data.length )
			xhttp.open(method, uri + "?" + serialize(data), true);
		else
			xhttp.open(method, uri, true );
		xhttp.send();
	}
}

function parse_get(val) {
    var result = "Not found",
        tmp = [];
    location.search
    //.replace ( "?", "" )
    // this is better, there might be a question mark inside
    .substr(1)
        .split("&")
        .forEach(function (item) {
        tmp = item.split("=");
        if (tmp[0] === val) result = decodeURIComponent(tmp[1]);
    });
    return result;
}

Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}
