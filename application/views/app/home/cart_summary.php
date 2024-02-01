
<?php $cart_data = $this->cart->contents(); if(is_array($cart_data)) { ?>
<?php  $count = count($this->cart->contents()); if (!$count) {  $count = 0; } ?>
<input type="hidden" value="<?php echo $count ?>" class="cart_items">

<?php $subtotal = 0; $total = 0; 
foreach($cart_data as $cart) { ?>
<?php $subtotal = $subtotal + ($cart['qty'] * $cart['price']); ?>
<?php $business_id= $cart['business_id'];?>
<?php } ?>
<input type="hidden" id="business_id" value="<?= isset($business_id)?$business_id:'0';?>"/>
<?php }else{ } ?>

<?php $total = $subtotal;?>
<input type="hidden" class="cart_total" value="<?php echo number_format($total, 2, ".", ","); ?>">