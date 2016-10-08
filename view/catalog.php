<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
	<title>MarketPlace</title>
	<link rel="stylesheet" type="text/css" href="./public/stylesheets/style.css">
	<script src="public/javascripts/utility.js"></script>
	<script src="public/javascripts/catalog.js"></script>
</head>
<body>

<div class="container">
  <?=$this->header?>
	<form action="home.php" method=GET>
		<input type="hidden" value="<?=$this->user->data->id?>" name="user_id" />
		<table width=100%>
			<tr>
				<td><input class=catalog-search type="text" placeholder="Search catalog ..." name="query" /></td>
				<td width=100><input class=catalog-submit type="submit" value="GO" /></td>
			</tr>
		</table>
		<table class=small-description>
			<tr>
				<td valign=top width=30>by</td>
				<td>
					<input type="radio" checked="checked" name="search_by" value="product" /> product<br>
					<input type="radio" name="search_by" value="store" /> store
				</td>
			</tr>
		</table>

	</form>
  <?=$this->products?>
</div>
</body>
</html>
