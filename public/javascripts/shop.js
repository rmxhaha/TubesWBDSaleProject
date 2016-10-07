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
  if( r == 0 )
    return "IDR " + x;
  else
    return money_f( r ) + "," + x % 1000;
}
