<div>
  <br>
  <div class="small-description">
    <?=$this->create_date?>
  </div>
  <hr>
  <table>
  <tr>
    <td class="transaction-left">
      <img width=100 src="<?=$this->product_image?>" />
    </td>
    <td class="transaction-mid">
        <b><?=$this->product_name?></b><br>
        <?=$this->total_price?><br>
        <?=$this->quantity?> pcs<br>
        @<?=$this->product_price?><br>
        <br>
        <div class=small-description>
          bought from <b><?=$this->seller_username?></b>
        </div>
    </td>
    <td class="transaction-right">
      <div class=small-description>
        Delivery to <b><?=$this->consignee?></b><br>
        <?=$this->address?><br>
        <?=$this->postcode?><br>
        <?=$this->phone?>
      </div>

    </td>
  </tr>
  </table>
</div>
