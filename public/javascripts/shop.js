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
  if( x < 0 ) x = 0;
  var r = Math.floor( x / 1000 );
  if( r == 0 )
    return "IDR " + x;
  else
    return money_f( r ) + "," + x % 1000;
}

function validate_purchase(){
  var q = document.getElementsByName("quantity")[0].value;
  var errors = [];
  if( isNaN(parseInt(q) ) )
    errors.push("Quantity must be a number");
  else if( parseInt(q) < 1 )
    errors.push("Quantity must be at least 1");

  var ccn = document.getElementsByName("credit_card_number")[0].value;
  var digit12 = /^\d{12}$/;
  if( !ccn.match(digit12) ){
    errors.push("Credit Card must be 12 digits");
  }

  var digit3 = /^\d{3}$/;
  var ccv = document.getElementsByName("credit_card_verification")[0].value;
  if( !ccv.match(digit3) ){
    errors.push("Credit Card Verification Number must be 3 digits");
  }

  var errors_container = document.getElementsByClassName("error-container")[0];
  errors_container.innerHTML = "";

  for( var i in errors ){
    var d = document.createElement("div");
    d.setAttribute("class","error");
    d.innerHTML = errors[i];
    errors_container.appendChild(d);
  }


  return ( errors.length == 0 );
}
