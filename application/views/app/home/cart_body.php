<div class="container">
    <div class="single-cart-item-wrapper">
        <?php  $count = count($this->cart->contents()); 
         if (!$count) {  $count = 0; } ?>
        <input type="hidden" class="cart_items" value="<?php echo $count ?>" >
        
        <?php 
        $subtotal = 0; $total = 0;
        $cart_data = $this->cart->contents(); 
        if(!empty($cart_data)) { ?>
        <?php foreach($cart_data as $cart) { ?>
        <?php $subtotal = $subtotal + ($cart['qty'] * $cart['price']); ?>
        <div class="row single-cart-item-row rowid-<?php echo $cart['rowid']?>">
            <div class="single-cart-item">
                 <div class="col-md-9 col-sm-9 col-xs-7">
                     <div class="services-name item-name">
                        <p class="name-item">
                            <a href="#" onclick="removeFromCart('<?php echo $cart['rowid']?>','<?php echo $cart['business_id']?>','<?php echo $cart['qty']?>');return false;" class="ripplelink">
                                <span class="fa fa-times " style="color: #ff546f;font-size: 18px;"></span> </a>
                        <?php echo getServiceName($cart['id'],$cart['business_id']); ?></p>
                     </div>
                 </div>
                 <div class="col-md-3 col-sm-3 col-xs-5">
                     <div class="service-cost">
                         <span class="price full-price">Tk <?php echo number_format($cart['price'] * $cart['qty'], 2, ".", ","); ?></span>
                     </div>
                 </div>
            </div>                     
        </div>
          <?php $business_id = $cart['business_id'];?>
          <?php } ?>
        <?php }else {?>
        <!--<h3>Empty Cart. -->
        <!--  <a href="<?= site_url('app/home/');?>">Back To Home</a>-->
        <!--</h3>-->
        <?php } ?>
    </div>
    <input type="hidden" id="business_id" value="<?=$business_id;?>"/>
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
                <?php 
                $marg_t="";
                if($this->session->userdata('coupon_code')){  
                    $active_display = "block";
                    $coupon_display = "none";
                    $marg_t="margin-top:0px";
                }else{ 
                    $active_display = "none";
                    $coupon_display = "table";
                } 
                ?>
                <div class="row single-total-cost-row" style="padding: 10px 0;">
                    <div class="col-md-6 col-sm-6 col-xs-5">
                        <h4 class="subtotal-text vouvher-text" style="<?=$marg_t;?>">Have a coupon?</h4>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-7 text-right">
                            <div id="coupon_active" style="line-height:1.1;display:<?=$active_display;?>">
                               <span class="text-success" style="font-size:14px">
                                    <small><?= $this->session->userdata('coupon_code');?></small>
                                </span> 
                                <span style="background: #ff546f;color: #fff;padding: 2px 5px;border: none;border-radius: 3px;" id="editCoupon">edit</span>
                                
                            </div>
                        
                        <div class="input-group" style="display:<?=$coupon_display;?>" id="coupon-group">  
                        
                            <input type="text" name="coupun_code" id="coupun_code" class="form-control" placeholder="Coupon code" style="border-right: none;">
                            <span class="input-group-btn ">
                                <button class="btn btn-default ripplelink" id="apply_btn" type="button" onclick="applyCoupon();return false;">Apply</button>
                            </span>
                        
                        </div>
                       
                    </div>
                </div>
                <?php if($this->session->userdata('coupon_code')){ ?>
                <div class="row single-total-cost-row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <h4 class="subtotal-text">Discount</h4>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                        <p class="subtotal-amount">Tk <?=$this->session->userdata('coupon_amount');?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>                            
    </div>
    
    <?php $total = $subtotal;?>
    <?php $total = $total - $this->session->userdata('coupon_amount'); ?>
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