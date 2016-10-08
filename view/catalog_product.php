<div class="product_<?=$this->product_id?>">
  <br>
  <div class="small-description">
    <b><?=$this->seller_name?></b><br>
    added this on <?=$this->create_date?><br>
  </div>
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
      <div class=clearfix>
        <div class="float-left">
          <b><a class="<?=$this->like_button_class?>" href="javascript:void(0)" onclick="like(this,<?=$this->product_id?>)"><?=$this->like_button_text?></a></b>
        </div>
        <div class="float-right">
          <b><a class="green" href="javascript:void(0)" onclick="buy(this,<?=$this->product_id?>)">BUY</a></b>
        </div>
      </div>
    </td>
  </tr>
  </table>
  <hr>
</div>
