<div>
  <?=$this->create_date?><br>
  <hr>
  <table>
  <tr>
    <td>
      <img width=200 src="<?=$this->product_image?>" />
    </td>
    <td>
      <h4><b><?=$this->product_name?></b></h4>
      <?=$this->product_price?><br>
      <?=$this->product_description?>
    </td>
    <td>
      <div class="like_count"><?=$this->like_count?> Likes </div>
      <div class="purchase_count"><?=$this->purchase_count?> Purchases </div>
      <a href="#">EDIT</a>
      <a href="#">DELETE</a>
    </td>
  </tr>
  </table>
</div>
