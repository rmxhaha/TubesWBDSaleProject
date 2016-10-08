<div class="header-container">
	<h1 class="FirstWord">Sale<span class="SecondWord">Project</span></h1>
    <div class="greeting small-description">
		Hi, <?=$this->user->username?>!<br>
		<a class="red" href="<?=$this->header_logout_link?>">logout</a>
	</div>
	<ul class="table-header-option">
			<li class="<?=$this->header_catalog_class?>">
				<a href="<?=$this->header_catalog_link?>">Catalog </a>
			</li>
			<li class="<?=$this->header_your_product_class?>">
				<a href="<?=$this->header_your_product_link?>">Your Products</a>
			</li>
			<li class="<?=$this->header_add_product_class?>">
				<a href="<?=$this->header_add_product_link?>">Add Product</a>
			</li>
			<li class="<?=$this->header_sales_class?>">
				<a href="<?=$this->header_sales_link?>">Sales </a>
			</li>
			<li class="<?=$this->header_purchases_class?>">
				<a href="<?=$this->header_purchases_link?>">Purchases </a>
			</li>
	</ul>
	<h2><?=$this->title?></h2>
	<hr>
</div>
