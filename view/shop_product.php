<div class="product_<?=$this->product_id?>">
  <?=$this->create_date?><br>
  <hr>
  <table>
  <tr>
    <td class="shop-product-left">
      <img width=100 src="<?=$this->product_image?>" />
    </td>
    <td class="shop-product-mid">
      <b><?=$this->product_name?></b><br>
      <?=$this->product_price?><br>
      <div class=small-description>
        <?=$this->product_description?>
      </div>
    </td>
    <td class="shop-product-right">
      <div class=small-description>
        <div class="like_count"><?=$this->like_count?> Likes </div>
        <div class="purchase_count"><?=$this->purchase_count?> Purchases </div>
      </div>
      <br>
      <a class="orange" href="javascript:edit_product(<?=$this->product_id?>)">EDIT</div>
      <a class="red" href="javascript:delete_product(<?=$this->product_id?>)">DELETE</div>
    </td>
  </tr>
  </table>
  <hr>
</div>
