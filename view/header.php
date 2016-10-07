<div class="header-container">
	<h1 class="FirstWord">Sale<span class="SecondWord">Project</span></h1>
    <div class="greeting">
		Hi, <?=$this->user["name"]?><br>
		<a href="<?=$this->header_logout_link?>">logout</a>
	</div>
	<style>
    .greeting{
    	text-align: right;
    }
	ul {
	    list-style-type: none;
	    margin: 0;
	    padding: 0;
	    overflow: hidden;
	    background-color: white;
	}

<<<<<<< HEAD
	li {
	    float: left;
	    width: 19.5%;
	    height: 40px;
	    border-right: 1px solid #000;
	    border-top: 1px solid #000;
	    border-bottom: 1px solid #000;
	    text-orientation: center;
	}
	li:first-of-type {
	    border-left: 1px solid #000;
	}
	li a {
	    display: block;
	    color: black;
	    text-align: center;
	    padding: 11px 11px;
	    text-decoration: none;
	}
=======
	<div class="header-user">
		Hi, <?=$this->user["name"]?><br>
		<a class="red" href="<?=$this->header_logout_link?>">logout</a>
	</div>
>>>>>>> 5ebb0ff18b7353f3b9c0bf5db2328433d0940258

	li a:hover:not(.active) {
	    background-color: blue;
	    color: white;
	}

	.active {
	    background-color: white;
	}
	</style>
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
