function like(element,pid){
  var user_id = parse_get("user_id");

	if( element.innerHTML == "LIKE" ){
		element.innerHTML = "UNLIKE";
    document.getElementsByClassName("like_count_"+pid)[0].innerHTML ++;
    request("GET","./like.php?user_id="+user_id+"&id="+pid,"",function(){
    });
	}
	else{
		element.innerHTML = "LIKE";
    document.getElementsByClassName("like_count_"+pid)[0].innerHTML --;
    request("GET","./like.php?user_id="+user_id+"&id="+pid,"",function(){
    });
	}
}
