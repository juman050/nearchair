<?php $subtotal = 0; $total = 0; ?>
<?php if(!empty($_SESSION["shopping_cart"])) { ?>
<?php  $count = count(array_keys($_SESSION["shopping_cart"])); ?>
<input type="hidden" value="<?php echo $count ?>" class="cart_items">
<?php
foreach($_SESSION["shopping_cart"] as $cart) { ?>
<?php $subtotal = $subtotal + ($cart['qty'] * $cart['servicePrice']); ?>
<?php } ?>
<?php }else{ } ?>

<?php $total = $subtotal;?>
<input type="hidden" class="cart_total" value="<?php echo number_format($total, 2, ".", ","); ?>">