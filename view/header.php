<div class="header-container">
	<h1>SaleProject</h1>

	Hi, <?=$this->user["name"]?><br>
	<a href="#">logout</a>


	<table class="table-header-option">
		<tr>
			<td class="<?=$this->header_catalog_class?>">Catalog</td>
			<td class="<?=$this->header_your_product_class?>">Your Products</td>
			<td class="<?=$this->header_add_product_class?>">Add Product</td>
			<td class="<?=$this->header_sales_class?>">Sales</td>
			<td class="<?=$this->header_purchases_class?>">Purchases</td>
		</tr>
	</table>
	<h2><?=$this->title?></h2>
	<hr>
</div>
