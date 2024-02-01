
<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/bootstrap-datetimepicker.css">
<div class="checkout-top-bar">
   <div class="container">
       <div class="row">
           <div class="col-md-12">
               <p style="max-width: 60%;">Do you want to modify your current order?</p>
               <span class="ripplelink"><a href="<?php echo site_url("app/homeservice"); ?>">Go Back</a></span>
           </div>
            <?php 
            if(!empty($system_data)){
                $title       = $system_data->nearchair_name;
                $description = $system_data->nearchair_description;
                $address     = $system_data->nearchair_address;
                $mobile      = $system_data->nearchair_mobile;
                $email       = $system_data->nearchair_email;
                $msg_email   = $system_data->nearchair_send_email;
                $loc         = $system_data->nearchair_location;
                $opening_time= $system_data->opening_time;
                $closing_time= $system_data->closing_time;
            }
            ?>
            <?php 
            $st_time = $opening_time.":00";
            $end_time = $closing_time.":00";
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
                <div class="barber-prof">
                   <h2 class="barber-name">Nearchair home service</h2>
                </div>
            </div>
       </div>
   </div>
</div>
<input type="hidden" value="<?=$customer_name;?>" name="customer_name" id="customer_name">
<input type="hidden" value="<?=$customer_contact;?>" name="customer_contact" id="customer_contact">
<input type="hidden" value="<?=$customer_area;?>" name="customer_area" id="customer_area">
<input type="hidden" value="<?=$customer_address;?>" name="customer_address" id="customer_address">

<section class="check-out-page" id="cart_contents">
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
    <div class="place-order-btn ripplelink" onclick="homeServiceCheckout();return false;">
        <div class="single-cart-part">
            
        </div>
        <div class="single-cart-part">
            <span class="text">BOOK NOW</span >
        </div>
        <div class="single-cart-part">
        </div>
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
					<h1>Thank You!</h1>
					<p>Your submission is received and we will contact you soon</p>
					<!--<h3 class="cupon-pop">Your Id: <span id="orderId"></span></h3>-->
					
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
        var d2 = new Date ( );
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
        
    })
    /*
    * This function is used to remove current home service from cart
    * @author:juman 
    * @date:06/10/2019 
    */
    function removeFromCart(rowId,serviceId){
        setTimeout(function() {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>app/homeservice/removeFromCart",
                data: {rowId:rowId,serviceId:serviceId},
                dataType : 'html',
                cache: false,
                beforeSend: function() {
                    $("#loader_modal").css('display','block');
                },
                success: function(html){
                    $("#loader_modal").css('display','none');
                    var cart_items = $('.cart_items').val();
                    if(Number(cart_items)>1){
                        $("#cart_contents").html(html);
                    }else{
                        $("#cart_contents").css("display","none");
                        $("#bottom-section-checkout").css("display","none");
                        $("#empty-cart").css("display","block");
                    }
                    
                    
                } 
            });
        }, 300);
    }
    
    /*
    * This function is used for checkout
    * @author:juman 
    * @date:06/09/09 
    */
    function homeServiceCheckout(){
        var cart_items = $('.cart_items').val();
        var cart_total = $('.cart_totals').val();
        var order_type = document.getElementById("order_type").value;
        if(cart_items && order_type=='0'){
            bookOrderNow();
        }else if(cart_items && order_type=='1'){
            advanceBooking();
        } else{
            window.location.replace("<?php echo site_url('app/homeservice')?>");
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
        var customer_name = document.getElementById("customer_name").value;
        var customer_contact = document.getElementById("customer_contact").value;
        var customer_area = document.getElementById("customer_area").value;
        var customer_address = document.getElementById("customer_address").value;
        var transaction_id = $("input#transaction_id").val();
        if(transaction_id=="" && (payment_method=='bkash' || payment_method=='rocket')){
            $("input#transaction_id").trigger( "focus" ); 
        }else{
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>app/homeservice/homeserviceOrder",
                data: {customer_name:customer_name,customer_contact:customer_contact,customer_area:customer_area,customer_address:customer_address,order_type:order_type,order_total:order_total, payment_method:payment_method,transaction_id:transaction_id},
                dataType : 'JSON',
                cache: false,
                success: function(response){
                    //if order false do something
                    if(response.available == 'off'){
                        $('#businessOff').modal('show');
                    }else if(response.available == 'on'){
                        if(response.order_status == '0'){
                            $('#orderFailed').modal('show');
                            setTimeout(function() {
                                window.location.replace("<?php echo site_url('app/homeservice')?>");
                            }, 3000);
                        }else{ 
                            //order success
                            $('#cart_contents').css('display','none');
                            $('#bottom-section-checkout').css('display','none');
                            $('#orderSuccess').modal('show');
                            //$('#orderId').html(response.order_status);
                            // setTimeout(function() {
                            //     window.location.replace("<?php echo site_url('app/homeservice')?>");
                            // }, 3000);
                            
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
        var customer_name = document.getElementById("customer_name").value;
        var customer_contact = document.getElementById("customer_contact").value;
        var customer_area = document.getElementById("customer_area").value;
        var customer_address = document.getElementById("customer_address").value;
        if(datetime){
            var transaction_id = $("input#transaction_id").val();
            if(transaction_id=="" && (payment_method=='bkash' || payment_method=='rocket')){
                $("input#transaction_id").trigger( "focus" ); 
            }else{
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url(); ?>app/homeservice/homeserviceOrder",
                    data: {customer_name:customer_name,customer_contact:customer_contact,customer_area:customer_area,customer_address:customer_address,order_type:order_type,order_total:order_total,payment_method:payment_method,datetime:datetime,transaction_id:transaction_id},
                    dataType : 'JSON',
                    cache: false,
                    success: function(response){
                        //if order false do something
                        if(response.available == 'off'){
                            $('#businessOff').modal('show');
                        }else if(response.available == 'on'){
                            if(response.order_status == '0'){
                                $('#orderFailed').modal('show');
                                setTimeout(function() {
                                    window.location.replace("<?php echo site_url('app/homeservice')?>");
                                }, 3000);
                            }else{ 
                                //order success
                                 $('#cart_contents').css('display','none');
                                $('#bottom-section-checkout').css('display','none');
                                $('#orderSuccess').modal('show');
                                //$('#orderId').html(response.order_status);
                                // setTimeout(function() {
                                //     window.location.replace("<?php echo site_url('app/homeservice')?>");
                                // }, 3000);
                            }
                            
                        }
                    } 
                });
            }
        }else{
            $("#datetime").trigger( "focus" ); 
        }
        
    }
    $('#orderSuccess').on('hidden.bs.modal', function () {
           window.location.replace("<?php echo site_url('app/homeservice')?>");
        })
</script>