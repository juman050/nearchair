<div class="container">
    <div class="single-cart-item-wrapper">
        <?php $subtotal = 0; $total = 0; ?>
       <?php if(!empty($_SESSION["shopping_cart"])) { ?>
        <?php  $count = count(array_keys($_SESSION["shopping_cart"])); ?>
        <input type="hidden" value="<?php echo $count ?>" class="cart_items">
        <?php foreach($_SESSION["shopping_cart"] as $cart) { ?>
        <?php $subtotal = $subtotal + ($cart['qty'] * $cart['servicePrice']); ?>
        <div class="row single-cart-item-row rowid-<?php echo $cart['serviceId']?>">
            <div class="single-cart-item">
                 <div class="col-md-9 col-sm-9 col-xs-7">
                     <div class="services-name item-name">
                        <p class="name-item">
                            <a href="#" onclick="removeFromCart('<?php echo $cart['rowId']?>','<?php echo $cart['serviceId']?>');return false;" class="ripplelink">
                                <span class="fa fa-times" style="color: #ff546f;font-size: 18px;"></span>
                            </a>
                        <?php echo getHomeServiceName($cart['serviceId']); ?></p>
                     </div>
                 </div>
                 <div class="col-md-3 col-sm-3 col-xs-5">
                     <div class="service-cost">
                         <span class="price full-price">Tk <?php echo number_format($cart['servicePrice'] * $cart['qty'], 2, ".", ","); ?></span>
                     </div>
                 </div>
            </div>                     
        </div>
        <?php } ?>
        <?php }else{?>
           <p>Empty Cart.</p>
        <?php } ?>
    </div>
    <div class="row total-cost-row">
        <div class="total-cost-wrapper">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row single-total-cost-row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <h4 class="subtotal-text">Subtotal</h4>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <p class="subtotal-amount">Tk <?php echo number_format($subtotal, 2, ".", ","); ?></p>
                    </div>
                </div>
            </div>
        </div>                            
    </div>
    
    <?php $total = $subtotal;?>
    <div class="row total-price-row">
        <div class="col-md-6 col-sm-6 col-xs-6">
            <h4 class="subtotal-text total">Total <span></span>   </h4>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            <p class="subtotal-amount">Tk <?php echo number_format($total, 2, ".", ","); ?></p>
        </div>
    </div>                    
</div>
<input type="hidden" class="cart_totals" value="<?php echo number_format($total, 2, ".", ","); ?>">