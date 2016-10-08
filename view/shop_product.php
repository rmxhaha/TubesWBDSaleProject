<div class="product_<?=$this->product_id?>">
  <br>
  <div class=small-description>
    <?=$this->create_date?>
  </div>
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
      <div class="clearfix">
        <div class="float-left">
          <b><a class="orange" href="javascript:edit_product(<?=$this->product_id?>)">EDIT</a></b>
        </div>
        <div class="float-right">
          <b><a class="red" href="javascript:delete_product(<?=$this->product_id?>)">DELETE</a></b>
        </div>
      </div>
    </td>
  </tr>
  </table>
  <hr>
</div>
