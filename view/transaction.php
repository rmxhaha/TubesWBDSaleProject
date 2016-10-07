<div>
  <?=$this->create_date?><br>
  <hr>
  <table>
  <tr>
    <td>
      <img width=200 src="<?=$this->product_image?>" />
    </td>
    <td>
        <b><?=$this->product_name?></b><br>
        <?=$this->total_price?><br>
        <?=$this->quantity?> pcs<br>
        @<?=$this->product_price?><br>
        <br>
      bought from <b><?=$this->seller_username?></b>
    </td>
    <td>
      Delivery to <?=$this->consignee?><br>
      <?=$this->address?><br>
      <?=$this->postcode?><br>
      <?=$this->phone?>

    </td>
  </tr>
  </table>
</div>
