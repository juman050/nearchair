<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/bootstrap-datetimepicker.css">
        <div class="checkout-top-bar">
           <div class="container">
               <div class="row">
                   <?php 
                    $businessData = getBusinessData($this->session->userdata('sess_business_id'));
                    $st_time = $businessData->opening_time.":00";
                    $end_time = $businessData->closing_time.":00";
                    $tz = 'Asia/Dhaka';
                    $tz_obj = new DateTimeZone($tz);
                    $today = new DateTime("now", $tz_obj);
                    $cur_time = $today->format('H:i:s');
                    
                    if($st_time <= $cur_time && $end_time >= $cur_time){
                        //echo "WE ARE OPEN NOW !!";
                        $open_close = "1";
                    }else{
                         //echo "WE ARE CLOSE  NOW !!";
                         $open_close = "0";
                    }
                    
                    
                    ?>
                   <div class="col-md-12  col-xs-12">
                       <p style="max-width: 60%;">Do you want to modify your current order?</p>
                       <span class="ripplelink"><a href="<?php echo site_url('app/business/'.$businessData->business_slug);?>">Go Back</a></span>
                   </div>
                   <div class="col-md-12  col-xs-12">
                       <div class="barber-prof">
                           <h2 class="barber-name"><?= $businessData->business_name;?></h2>
                            <div class="bottom-widget-wrapper">
                                <div class="widget">
                                    <img height="16px" src="<?php echo site_url('resource/icons/noun_salon chair_266981.svg');?>" /> <?=$businessData->total_chairs;?>
                                </div>
                                <div class="widget">
                                    <span class='widget-text'>AC</span>
                                </div>   
                                   
                                <div class="widget">
                                    <span class='widget-text'>
                                        <?php 
                                        if($businessData->business_on_off==0 && $open_close==1){ 
                                            echo '<span style="color:#ff6aa5">BUSY</span>';
                                            
                                        }else if($businessData->business_on_off==1 && $open_close==1){
                                            echo '<span style="color:#12CC94">AVAILABLE</span>'; 
                                        }else{ 
                                            echo '<span style="">CLOSED</span>'; 
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="widget">
                                    <i class="fa fa-star star"></i>
                                    <?php
                                    $rating_avg = ratingAvg($businessData->business_id);
                                    ?>
                                    <?=$rating_avg;?>/5
                                    <span class="review-count">
                                        (<?php echo totalReview($businessData->business_id);?>)
                                    </span>
                                </div>
                            </div>
                        </div>
                   </div>
               </div>
           </div>
        </div>
        <section class="check-out-page" id="cart_contents">
            <div class="container">
                <div class="single-cart-item-wrapper">
                    
                    <?php $cart_data = $this->cart->contents(); if(is_array($cart_data)) { ?>
                    <?php  $count = count($this->cart->contents()); if (!$count) {  $count = 0; } ?>
                    <input type="hidden" value="<?php echo $count ?>" class="cart_items">
                    <?php $subtotal = 0; $total = 0; foreach($cart_data as $cart) { ?>
                    <?php $subtotal = $subtotal + ($cart['qty'] * $cart['price']); ?>
                    <div class="row single-cart-item-row rowid-<?php echo $cart['rowid']?>">
                        <div class="single-cart-item">
                             <div class="col-md-9 col-sm-9 col-xs-7">
                                 <div class="services-name item-name">
                                    <p class="name-item">
                                        <a href="#" onclick="removeFromCart('<?php echo $cart['rowid']?>','<?php echo $cart['business_id']?>','<?php echo $cart['qty']?>');return false;" class="ripplelink">
                                            <span class="fa fa-times" style="color: #ff546f;font-size: 18px;"></span></a>
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
                    <?php }else{?>
                       <p>Empty Cart.</p>
                    <?php } ?>
                </div>
                <input type="hidden" id="business_id" value="<?= isset($business_id)?$business_id:'0';?>"/>
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
                                                <?= $this->session->userdata('coupon_code');?>
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
        </section>
        
        <div class="container" id="bottom-section-checkout">
            <div class="row order_type_row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <h4 class="order_type_text">Order Type </h4>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                    <select class="order_type" id="order_type">
                        <?php if($open_close==1){?>
                        <option value="0">Just Now</option>
                        <?php } ?>
                        <option value="1">Advanced</option>
                    </select>
                </div>
            </div> 
            <div class="row order_type_row advance_booking_row" <?php if($open_close==0){?> style="display:block" <?php }?>>
                <div class="col-md-6 col-sm-6 col-xs-5">
                    <h4 class="order_type_text">Booking Time </h4>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-7 text-right">
                    <div class="input-group date" style="width: 100%;">
                      <input type="text" class="form-control pull-right" id="datetime" value="" placeholder="yyyy-mm-dd hh:ii" readonly>
                    </div>
                </div>
            </div>
            <div class="row order_type_row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <h4 class="order_type_text">Payment Method </h4>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                    <select class="payment_method" id="payment_method">
                        <option value="cod">Cash</option>
                        <option value="bkash">Bkash</option>
                        <option value="rocket">Rocket</option>
                    </select>
                </div>
            </div> 
            <div class="row transaction_row" style="display:none">
                <div class="col-md-6 col-sm-6 col-xs-5">
                </div>
                <div class="col-md-6 col-sm-6 col-xs-7 text-right">
                    <div class="input-group" style="width: 100%;">
                      <input type="text" class="form-control pull-right" id="transaction_id" value="" placeholder="Enter transaction id">
                    </div>
                </div>
            </div>
            
            <div class="place-order-btn ripplelink" onclick="checkout();return false;">
                <!--<div class="single-cart-part">-->
                <!--    // $count = count($this->cart->contents());-->
                <!--<i class="fa fa-calendar" style="color:#fff;font-size: 18px;"></i><span class="item-count cart_item_count" style="top: 12px;"></span>-->
                <!--    </div>-->
                <div class="single-cart-part">
                    <span class="text">Place Order</span >
                </div>
                <!--<div class="single-cart-part">-->
                <!--    <span class="amount-text cart_total_amount">Tk <?php echo number_format($total, 2, ".", ","); ?></span >-->
                <!--</div>-->
            </div>
        </div>   
        
        <div class="container" id="empty-cart" style="display:none">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="emptycart_wrap">
                        <div class="emptycart_img">
                            <img src="<?= site_url();?>resource/app/images/empty.svg" class="img-responsive"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <!--<h3>Sorry!</h3>-->
                    <a href="<?= site_url('app/home');?>" class="btn btn-info go-to-business">Back To Nearchair</a>
                </div>
            </div> 
        </div>
        
        <!-- order success reponse message pop-up -->
        <div class="modal fade" id="orderSuccess" role="dialog">
            <div class="modal-dialog" style="top: 20%;">
                <div class="modal-content">
                    <div class="modal-body">
                        
						<div class="thank-you-pop">
							<img src="<?php echo site_url('resource/app/images/Green-Round-Tick.png'); ?>" alt="">
							<h1>Booking successfull!</h1>
							<p>Your submission is received and we will contact you soon</p>
							<h3 class="cupon-pop">Your serial number: <span id="orderId"></span></h3>
							
 						</div>
                         
                    </div>
					
                </div>
            </div>
        </div>
        
        <!-- order failed reponse message pop-up -->
        <div class="modal fade" id="orderFailed" role="dialog">
            <div class="modal-dialog" style="top: 20%;">
                <div class="modal-content">
                    <div class="modal-body">
						<div class="thank-you-pop">
							<img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
							<h1>Sorry! Something Wents Wrong.</h1>
							<p>Please try later</p>
							
 						</div>
                         
                    </div>
					
                </div>
            </div>
        </div>
        
    <!-- business Off reponse message pop-up -->
    <div class="modal fade" id="businessOff" role="dialog">
        <div class="modal-dialog" style="top: 20%;">
            <div class="modal-content">
                <div class="modal-body">
					<div class="thank-you-pop">
						<h1>Due to high volume of orders we are temporarily closed now! </h1>
						<p>We will be back soon! Apologies for the inconvenience</p>
						
 					</div>
                     
                </div>
				
            </div>
        </div>
    </div>
        
    <!-- Modal -->
    <div class="modal fade" id="couponModal" role="dialog" >
        <div class="modal-dialog modal-sm" style="top: 20%;">
          <div class="modal-content">
            <div class="modal-body">
              <p class="text-center" style="color: #F44336;margin:0"><span id="response_text" ></span><button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button></p>
            </div>
        </div>
      </div>
    </div>
    <div id="loader_modal">
        <img id="loader_img" src="<?php echo site_url('resource/app/icon/loadingImage.gif');?>" />
        <p class="text-center">Please wait a moment</p>
    </div>
    <script src="<?php echo base_url(); ?>resource/app/js/bootstrap-datetimepicker.min.js"></script> 
    <script>
        
        $(function () {
            /*
            * This function is used to get date time
            * @author:juman 
            * @date:08/09/09 
            */
            
            var today = new Date();
            var currentday = new Date(today.getFullYear(), today.getMonth(), today.getDate());
            var d2 = new Date ();
            d2.setHours ( today.getHours() + 1 );
            var overmorrow = new Date(today.getFullYear(), today.getMonth(), (today.getDate() + 6));
            $input = $("#datetime");
            $input.datetimepicker({
                format: 'yyyy-mm-dd hh:ii',
                autoclose: true,
                startDate: d2,
                endDate: overmorrow,
                hoursDisabled: [1,2, 3, 4, 5, 6, 7, 8, 9],
                pickerPosition: 'top-left',
                showMeridian: true
            });
            
            
            /*
            * This function is used for detect advance order type
            * @author:juman 
            * @date:06/09/09 
            */
            
            $(".order_type").on('change', function () {   
                var cart_items = $('.cart_items').val();
                var order_type = document.getElementById("order_type").value;
                if(cart_items && order_type=='1'){
                    $(".advance_booking_row").show();   
                    $( "#datetime" ).trigger( "focus" ); 
                }
                if(cart_items && order_type=='0'){
                    $(".advance_booking_row").hide();   
                }
            }); 
            
            $(".payment_method").on('change', function () {  
                var payment_method = document.getElementById("payment_method").value;
                if(payment_method=='bkash' || payment_method=='rocket'){ 
                    $( ".transaction_row" ).css( "display","block" ); 
                    $( "#transaction_id" ).trigger( "focus" ); 
                }
                if(payment_method=='cod'){
                    $( ".transaction_row" ).css( "display","none" ); 
                }
            });
            
          
            //edit coupon code
            $("#editCoupon").on('click', function () {  
                $("#coupon_active").css("display","none");
                $("#coupon-group").css("display","table");
            });
        })

    </script>
    <script>
       /*
        * This function is used to apply coupon code
        * @author:juman 
        * @date:30/09/09 
        */
         function applyCoupon() {  
            var coupon_code = $("input#coupun_code").val();
            if(coupon_code==""){
                $("input#coupun_code").trigger( "focus" ); 
            }else{
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url(); ?>app/applyCoupon",
                    data: {coupon_code: coupon_code},
                    dataType : "json",
                    
                    success: function(data){
                        
                        if(data.status=="TRUE"){
                            window.location.reload();
                        }else if(typeof(data.minimum_total)!== 'undefined'){
                            $("#couponModal").modal("show");
                            $("#response_text").html(data.minimum_total);
                        }else{
                            $("#couponModal").modal("show");
                            $("#response_text").html("Invalid coupon code");
                        }
                    } 
                });
            }
        }
        /*
        * This function is used to store data to cart
        * @author:juman 
        * @date:06/09/09 
        */
        function addToCart(category_id,service_id,service_price,service_time,business_id){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>app/addToCart",
                data: {category_id: category_id,service_id:service_id,service_price:service_price,service_time:service_time,qty:"1",business_id:business_id},
                dataType : 'html',
                cache: false,
                
                success: function(html){
                    $("#cart_contents").html(html);
                    var cart_totals = $('.cart_totals').val();
                    var cart_items = $('.cart_items').val();
                    $('.cart_total_amount').text("Tk "+cart_totals);
                    $('.cart_item_count').text(cart_items);
                } 
            });
        }
        /*
        * This function is used to remove current service from cart
        * @author:juman 
        * @date:06/09/09 
        */
        function removeFromCart(rowid,business_id,qty){
            setTimeout(function() {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url(); ?>app/removeFromCart",
                    data: {rowid:rowid,business_id:business_id, qty:qty},
                    dataType : 'html',
                    cache: false,
                    beforeSend: function() {
                        $("#loader_modal").css('display','block');
                    },
                    success: function(html){
                        $("#loader_modal").css('display','none');
                        var cart_totals = $('.cart_totals').val();
                        var cart_items = $('.cart_items').val();
                        if(Number(cart_items)>1){
                            $("#cart_contents").html(html);
                        }else{
                            $("#cart_contents").css("display","none");
                            $("#bottom-section-checkout").css("display","none");
                            $("#empty-cart").css("display","block");
                            $('span.cart-item').css("display","none");
                        }
                        var cart_totals = $('.cart_totals').val();
                        var cart_items = $('.cart_items').val();
                        $('span.cart_total_amount').html("Tk "+cart_totals);
                        $('span.cart_item_count').html(cart_items);
                        $('span.cart-item').html(cart_items);
                        
                    } 
                });
            }, 500);
        }
        
        /*
        * This function is used for checkout
        * @author:juman 
        * @date:06/09/09 
        */
        function checkout(){
            var cart_items = $('.cart_items').val();
            var cart_total = $('.cart_totals').val();
            var order_type = document.getElementById("order_type").value;
            if(cart_items && order_type=='0'){
                bookOrderNow();
            }else if(cart_items && order_type=='1'){
                advanceBooking();
            } else{
                alert('Something went wrong.');
            }
            
        }
        /*
        * This function is used to book order Now
        * @author:juman 
        * @date:06/09/09 
        */
        function bookOrderNow(){
            var order_total = $('.cart_totals').val();
            var order_type     = document.getElementById("order_type").value;
            var payment_method = document.getElementById("payment_method").value;
            var business_id = document.getElementById("business_id").value;
            var transaction_id = $("input#transaction_id").val();
            if(transaction_id=="" && (payment_method=='bkash' || payment_method=='rocket')){
                $("input#transaction_id").trigger( "focus" ); 
            }else{
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url(); ?>app/bookOrderNow",
                    data: {order_type:order_type,order_total:order_total, payment_method:payment_method,business_id:business_id,transaction_id:transaction_id},
                    dataType : 'JSON',
                    cache: false,
                    success: function(response){
                        //if order false do something
                        if(response.available == 'off'){
                            $('#businessOff').modal('show');
                        }else if(response.available == 'on'){
                            if(response.user_login=='true'){
                                if(response.order_status !== '0'){
                                    $("#cart_contents").css("display","none");
                                    $("#bottom-section-checkout").css("display","none");
                                    $("#empty-cart").css("display","block");
                                    $('span.cart-item').css("display","none");
                                    $('#orderSuccess').modal('show');
                                    $('#orderId').html(response.order_status);
                                    pushNotification(response.order_status)
                                }else{ 
                                    $('#orderFailed').modal('show');
                                    
                                }
                            }else{
                                window.location.replace("<?php echo site_url('app/user')?>");
                            }
                            
                        }
                    } 
                });
            }
            
            
        }
        /*
        * This function is used for advance booking
        * @author:juman 
        * @date:06/09/09 
        */
        function advanceBooking(){
            var datetime = $("#datetime").val();
            var order_total = $('.cart_totals').val();
            var order_type     = document.getElementById("order_type").value;
            var payment_method = document.getElementById("payment_method").value;
            var business_id = document.getElementById("business_id").value;
            if(datetime){
                var transaction_id = $("input#transaction_id").val();
                if(transaction_id=="" && (payment_method=='bkash' || payment_method=='rocket')){
                    $("input#transaction_id").trigger( "focus" ); 
                }else{
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url(); ?>app/advanceBooking",
                        data: {order_type:order_type,order_total:order_total,payment_method:payment_method,business_id:business_id,datetime:datetime,transaction_id:transaction_id},
                        dataType : 'JSON',
                        cache: false,
                        success: function(response){
                            //if order false do something
                            if(response.available == 'off'){
                                $('#businessOff').modal('show');
                            }else if(response.available == 'on'){
                                if(response.user_login=='true'){
                                    if(response.order_status !== '0'){
                                        //order success
                                        $("#cart_contents").css("display","none");
                                        $("#bottom-section-checkout").css("display","none");
                                        $("#empty-cart").css("display","block");
                                        $('span.cart-item').css("display","none");
                                        $('#orderSuccess').modal('show');
                                        $('#orderId').html(response.order_status);
                                        pushNotification(response.order_status)
                                        
                                        
                                    }else{ 
                                        $('#orderFailed').modal('show');
                                    }
                                }else{
                                    window.location.replace("<?php echo site_url('app/user')?>");
                                }
                                
                            }
                        } 
                    });
                }
            }else{
                $("#datetime").trigger( "focus" ); 
            }
            
        }
        
        /*
        * This function is used to send pushNotification
        * @author:juman 
        * @date:03/11/19 
        */
        function pushNotification(order_id){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>app/pushNotification",
                data: {order_id:order_id},
                dataType : 'JSON',
                cache: false,
                success: function(response){
                    console.log(response)
                } 
            });
            
        }
        //$('#orderSuccess').on('hidden.bs.modal', function () {
          // window.location.replace("");
        //})
    </script>