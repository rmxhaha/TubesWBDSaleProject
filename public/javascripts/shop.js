function delete_product(product_id){
  var user_id = parse_get("user_id");
  var result = confirm("Want to delete?");
  if( result ){
    request("GET","./shop.php?action=delete_product&user_id="+user_id+"&id="+product_id,"",function(){
      console.log(product_id + " has been deleted");
      document.getElementsByClassName("product_"+product_id).remove();
    });
  }
}

function edit_product(product_id){
  var user_id = parse_get("user_id");
  window.location = "./shop.php?action=edit_product&user_id=" + user_id + "&id=" + product_id;
}

function update_total_price(element){
  var val = parseInt( element.value );

  if( isNaN(val) ) val = 0;

  document.getElementById("total_price").innerHTML = money_f( element.getAttribute("product-price") * val );
}

function money_f(x){
  var r = Math.floor( x / 1000 );
  var x = Math.floor( x % 1000 );

  var x_str = x.toString();
  while( x_str.length < 3 ) x_str = "0" + x_str;

  if( r == 0 )
    return "IDR " + x;
  else
    return money_f(r) + "." + x_str;
}

function validate_product(){
  var name = document.getElementsByName("product_name")[0].value;
  var price = document.getElementsByName("product_price")[0].value;
  var desc = document.getElementsByName("product_description")[0].value;
  var errors = [];

  if( !validateName(name) ){
    errors.push("Product name must be characters and space only");
  }

  if( !validatePositiveNumber(price) ){
    errors.push("Price must be a positive number")
  }

  if( desc.length > 200 ){
    errors.push("Description must be no more than 200 characters");
  }

  show_error(errors);

  return errors.length == 0;
}


function validate_purchase(){
  var q = document.getElementsByName("quantity")[0].value;
  var errors = [];

  function get(x){
		return document.getElementsByName(x)[0].value;
	}

	function check(v, msg){
		if(!v)
			errors.push(msg);
	}

  check( validatePositiveNumber(get("quantity")), "Quantity must be a positive number" );

  check( validatePositiveNumber(get("phone")) && get("phone").length >= 6 && get("phone").length <= 15, "Phone number is invalid" );

  check( validateName(get("consignee")), "consignee must be filled" );

  var postcode = get("postcode");
  check( validatePositiveNumber(postcode) && postcode.length == 5, "Postcode must be 5 digits number");


  var digit12 = /^\d{12}$/;
  check( get("credit_card_number").match(digit12), "Credit Card must be 12 digits");

  var digit3 = /^\d{3}$/;
  check( get("credit_card_verification").match(digit3), "Credit Card Verification number must be 3 digits");

  check( get("fulladdress").length > 5 && get("fulladdress").length <= 200, "Address is too short or too long" );

  show_error(errors);

  if( errors.length == 0 ){
    var result = confirm("Apakah data yang anda masukan benar?");
    return result;
  }

  return false;
}
