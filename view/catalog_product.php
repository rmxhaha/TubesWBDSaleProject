<div class="product_<?=$this->product_id?>">
  <b><?=$this->seller_name?></b><br>
  added this on <?=$this->create_date?><br>
  <hr>
  <table>
  <tr>
    <td><img width=200 src="<?=$this->product_image?>" /></td>
    <td>
      <h4><b><?=$this->product_name?></b></h4>
      <?=$this->product_price?><br>
      <?=$this->product_description?>
    </td>
    <td>
      <div><span class="like_count_<?=$this->product_id?>"><?=$this->like_count?></span> Likes </div>
      <div><span class="purchase_count_<?=$this->product_id?>"><?=$this->purchase_count?></span> Purchases </div>
      <a href="javascript:void(0)" onclick="like(this,<?=$this->product_id?>)"><?=$this->like_button_text?></a>
      <a href="javascript:void(0)" onclick="buy(this,<?=$this->product_id?>)">BUY</a>
    </td>
  </tr>
  </table>
</div>
