<div class="header-container">
	<h1 class="FirstWord">Sale<span class="SecondWord">Project</span></h1>

	Hi, <?=$this->user["name"]?><br>
	<a href="<?=$this->header_logout_link?>">logout</a>


	<table class="table-header-option">
		<tr>
			<td class="<?=$this->header_catalog_class?>">
				<a href="<?=$this->header_catalog_link?>">Catalog</a>
			</td>
			<td class="<?=$this->header_your_product_class?>">
				<a href="<?=$this->header_your_product_link?>">Your Products</a>
			</td>
			<td class="<?=$this->header_add_product_class?>">
				<a href="<?=$this->header_add_product_link?>">Add Product</a>
			</td>
			<td class="<?=$this->header_sales_class?>">
				<a href="<?=$this->header_sales_link?>">Sales</a>
			</td>
			<td class="<?=$this->header_purchases_class?>">
				<a href="<?=$this->header_purchases_link?>">Purchases</a>
			</td>
		</tr>
	</table>
	<h2><?=$this->title?></h2>
	<hr>
</div>
