function like(element,pid){
  var user_id = parse_get("user_id");

	if( element.innerHTML == "LIKE" ){
		element.innerHTML = "LIKED";
    element.className = "red";
    document.getElementsByClassName("like_count_"+pid)[0].innerHTML ++;

    request("GET","./like.php?user_id="+user_id+"&id="+pid,"",function(){
    });
	}
	else{
    element.className = "blue";
		element.innerHTML = "LIKE";
    document.getElementsByClassName("like_count_"+pid)[0].innerHTML --;
    request("GET","./like.php?user_id="+user_id+"&id="+pid,"",function(){
    });
	}
}

function buy(element,pid){
  window.location = "./shop.php?action=buy_product&user_id="+parse_get("user_id")+"&id="+pid;
}
