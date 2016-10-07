<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
	<title>MarketPlace</title>
	<link rel="stylesheet" type="text/css" href="./public/stylesheets/style.css">
</head>
<body>

<div class="container">
  <?=$this->header?>
  <?=$this->products?>
</div>
<script src="public/javascripts/catalog.js"></script>
<script>
function like(element){
	var pid = element.getAttribute("product-id");
	if( element.innerHTML == "LIKE" ){
		element.innerHTML = "UNLIKE";
		element.parentElement.children[1].innerHTML ++;
	}
	else{

		document.getElementsByClassName("like_count_"+pid)[0].innerHTML --;
		element.innerHTML = "LIKE";

	}
}

</script>
</body>
</html>
