<div class="product_<?=$this->product_id?>">
  <b><?=$this->seller_name?></b><br>
  added this on <?=$this->create_date?><br>
  <hr>
  <table>
  <tr>
    <td class="catalog-product-left"><img width=100 src="<?=$this->product_image?>" /></td>
    <td class="catalog-product-mid">
      <b><?=$this->product_name?></b><br>
      <?=$this->product_price?><br>
      <div class=small-description>
        <?=$this->product_description?>
      </div>
    </td>
    <td class="catalog-product-right">
      <div class="small-description">
        <div><span class="like_count_<?=$this->product_id?>"><?=$this->like_count?></span> Likes </div>
        <div><span class="purchase_count_<?=$this->product_id?>"><?=$this->purchase_count?></span> Purchases </div>
      </div>
      <br>
      <a class="blue" href="javascript:void(0)" onclick="like(this,<?=$this->product_id?>)"><?=$this->like_button_text?></a>
      <a class="green" href="javascript:void(0)" onclick="buy(this,<?=$this->product_id?>)">BUY</a>
    </td>
  </tr>
  </table>
  <hr>
</div>
