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
<header><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    <div class="header-slider owl-carousel">
        <div class="item slider-img" style="background-image: url('<?php echo site_url("/drives/slider/home-service.png")?>');">
            <div class="overlay">
                <div class="container">
                    <div class="row">  
                    </div>
                </div>
            </div>
        </div>
        <div class="item slider-img" style="background-image: url('<?php echo site_url("/drives/slider/all-in-one.png")?>');">
            <div class="overlay">
                <div class="container">
                    <div class="row">  
                    </div>
                </div>
            </div>
        </div>
    </div> 
</header>

<section class="profile-section" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');min-height: 100vh;padding-top: 0px;">
    <div class="container">
        <div class="row" style="background:#fff">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="barber-prof">
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
                    <h2 class="barber-name"><?//=$title?>NearChair Home Service</h2>
                    <input type="hidden" id="open_close" value="<?=$open_close;?>"/>
                    <input type="hidden" id="business_busy" value="<?= $system_data->home_service; ?>"/>
                </div>
            </div>
        </div>
                    <div class="row">
                    
                        <div class="tabmenu-wrapper-div">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs custom-nav-tabs" role="tablist">
                                <li role="presentation" class="active custom-navtab-item "><a href="#Service" aria-controls="service" role="tab" data-toggle="tab" class="service">Men</a></li>
                                <li role="presentation" class="custom-navtab-item "><a href="#About" aria-controls="about" role="tab" data-toggle="tab" class="about">Women</a></li>
                                <li role="presentation" class="custom-navtab-item "><a href="#testimonial" aria-controls="review" role="tab" data-toggle="tab" class="review">Terms</a></li>
                            </ul>
                        <div class="col-md-12 col-sm-12 col-xs-12 pad-10">
                            <!-- Tab panes -->
                            <div class="tab-content custom-tab-content">
                                <div role="tabpanel" class="tab-pane custom-tab-panel active" id="Service">
                                    <div class="panel-wrapper">
                                        <div class="panel-group wrap custom-panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            
                                         <?php if(!empty($categories)){ $count=0; foreach ($categories as $category){ $count++; ?>    
                                            <?php if(getTotalHomeService($category->category_id)>0){ ?>
                                            <div class="panel custom-panel">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#cat<?=$category->category_id;?>" aria-expanded="true" aria-controls="cat<?=$category->category_id;?>">
                                                          <?=$category->category_name;?> 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="cat<?=$category->category_id;?>" class="panel-collapse collapse in service_list_div" role="tabpanel" aria-labelledby="headingOne">
                                                  <div class="panel-body">
                                                    <ul class="item list-unstyled hair-ul">
                                                        <?php $get_service = getHomeServiceUnderCategory($category->category_id) ;?>
                                                        <?php if(!empty($get_service)){ $remove_border_first=0;  foreach ($get_service as $service){ $remove_border_first++;  ?>
                                                        <?php if($service->serviceDiscountPrice>0){ 
                                                                 $price = $service->serviceDiscountPrice; 
                                                                }else{ $price = $service->servicePrice; } 
                                                        $remove_border_style="";
                                                        if($remove_border_first==1) {
                                                            $remove_border_style="border-top:0;";
                                                        }
                                                        ?>
                                                        <li style="<?=$remove_border_style;?>" class="item-list item_modify<?php echo $service->serviceId?> ripplelink" data-cl="<?php echo checkHomeServiceCart($service->serviceId);?>" onclick="addcartData('<?php echo $category->category_id?>','<?php echo $service->serviceId?>','<?php echo $price?>','<?php echo $service->serviceTime?>');return false;">
                                                            <span class="item-name" style="width:65%"><?= $service->serviceName;?></span>
                                                            
                                                            <span class="item-price"><?php if($service->serviceDiscountPrice>0){ echo "<strike><small class='text-danger'>TK ".$service->servicePrice."</small></strike> Tk ".$service->serviceDiscountPrice; }else{ echo "Tk ".$service->servicePrice; } ?></span>
                                                            
                                                            <span class="add-to-cart <?php if(checkHomeServiceCart($service->serviceId)=='clicked'){ echo 'green_color';}?>"><a href="" class="modify_icon<?php echo $service->serviceId?>">
                                                                <?php if(checkHomeServiceCart($service->serviceId)=='clicked'){ echo '<i class="fa fa-check-circle"></i>';}else{echo '+';}?>
                                                            </a>
                                                             <img class="ajax-loading" style="display:none;width:18px" src="<?php echo site_url('resource/app/icon/loadingImage.gif');?>">
                                                            </span>
                                                        </li>
                                                        <?php } }else{ ?>
                                                            <div class="alert alert-danger">No service found.</div>
                                                        <?php }?>
                                                        
                                                    </ul>
                                                  </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                              <!-- end of panel -->
                                            <?php } }else{ ?>
                                                <div class="alert alert-danger">Data not found.</div>
                                            <?php }?>
                                              

                                            
                                        </div>
                                        <!-- end of #accordion -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane custom-tab-panel" id="About">
                                    <div class="panel-wrapper">
                                        <div class="panel-group wrap custom-panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                            
                                         <?php if(!empty($categories2)){ $count=0; foreach ($categories2 as $category){ $count++; ?>    
                                            <?php if(getTotalHomeService($category->category_id)>0){ ?>
                                            <div class="panel custom-panel">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#cat<?=$category->category_id;?>" aria-expanded="true" aria-controls="cat<?=$category->category_id;?>">
                                                          <?=$category->category_name;?> 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="cat<?=$category->category_id;?>" class="panel-collapse collapse in service_list_div" role="tabpanel" aria-labelledby="headingOne">
                                                  <div class="panel-body">
                                                    <ul class="item list-unstyled hair-ul">
                                                        <?php $get_service = getHomeServiceUnderCategory($category->category_id) ;?>
                                                        <?php if(!empty($get_service)){ $remove_border_first=0;  foreach ($get_service as $service){ $remove_border_first++;  ?>
                                                        <?php if($service->serviceDiscountPrice>0){ 
                                                                 $price = $service->serviceDiscountPrice; 
                                                                }else{ $price = $service->servicePrice; } 
                                                        $remove_border_style="";
                                                        if($remove_border_first==1) {
                                                            $remove_border_style="border-top:0;";
                                                        }
                                                        ?>
                                                        <li style="<?=$remove_border_style;?>" class="item-list item_modify<?php echo $service->serviceId?> ripplelink" data-cl="<?php echo checkHomeServiceCart($service->serviceId);?>" onclick="addcartData('<?php echo $category->category_id?>','<?php echo $service->serviceId?>','<?php echo $price?>','<?php echo $service->serviceTime?>');return false;">
                                                            <span class="item-name" style="width:65%"><?= $service->serviceName;?></span>
                                                            
                                                            <span class="item-price">Tk <?php if($service->serviceDiscountPrice>0){ echo "<strike>".$service->servicePrice."</strike> ".$service->serviceDiscountPrice; }else{ echo $service->servicePrice; } ?></span>
                                                            
                                                            <span class="add-to-cart <?php if(checkHomeServiceCart($service->serviceId)=='clicked'){ echo 'green_color';}?>"><a href="" class="modify_icon<?php echo $service->serviceId?>">
                                                                <?php if(checkHomeServiceCart($service->serviceId)=='clicked'){ echo '<i class="fa fa-check-circle"></i>';}else{echo '+';}?>
                                                            </a>
                                                             <img class="ajax-loading" style="display:none;width:18px" src="<?php echo site_url('resource/app/icon/loadingImage.gif');?>">
                                                            </span>
                                                        </li>
                                                        <?php } }else{ ?>
                                                            <div class="alert alert-danger">No service found.</div>
                                                        <?php }?>
                                                        
                                                    </ul>
                                                  </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                              <!-- end of panel -->
                                            <?php } }else{ ?>
                                                <div class="alert alert-danger">Data not found.</div>
                                            <?php }?>
                                              

                                            
                                        </div>
                                        <!-- end of #accordion -->
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane custom-tab-panel review-tab" id="testimonial">
                                    <div class="about-us-content">
                                        <p>Terms and conditions</p>
                                    </div>
                                    <!--<div class="testimonial" style="width: 100%;" id="review-content-div">-->
                                    
                                        <!--<h3><strong>Testimonial</strong></h3>-->
                                        <!--<div class="seprator"></div>-->
                                    <!--        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">-->
                                              <!-- Wrapper for slides -->
                                    <!--          <div class="carousel-inner">-->
                                    <!--            <div class="item active">-->
                                    <!--              <div class="row" style="padding: 20px">-->
                                    <!--                <button class="quote-btn"><i class="fa fa-quote-left testimonial_fa" aria-hidden="true"></i></button>-->
                                    <!--                <p class="testimonial_para">Lorem Ipsum ist ein einfacher Demo-Text für die Print- und Schriftindustrie. Lorem Ipsum ist in der Industrie bereits der Standard Demo-Text "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo en.</p><br>-->
                                    <!--                <div class="row">-->
                                    <!--                <div class="col-sm-2">-->
                                    <!--                    <img src="http://demos1.showcasedemos.in/jntuicem2017/html/v1/assets/images/jack.jpg" class="img-responsive" style="width: 80px">-->
                                    <!--                    </div>-->
                                    <!--                    <div class="col-sm-10">-->
                                    <!--                    <h4><strong>Jack Andreson</strong></h4>-->
                                    <!--                    <p class="testimonial_subtitle"><span>Chlinical Chemistry Technologist</span><br>-->
                                    <!--                    <span>Officeal All Star Cafe</span>-->
                                    <!--                    </p>-->
                                    <!--                </div>-->
                                    <!--                </div>-->
                                    <!--              </div>-->
                                    <!--            </div>-->
                                    <!--           <div class="item">-->
                                    <!--               <div class="row" style="padding: 20px">-->
                                    <!--                <button class="quote-btn"><i class="fa fa-quote-left testimonial_fa" aria-hidden="true"></i></button>-->
                                    <!--                <p class="testimonial_para">Lorem Ipsum ist ein einfacher Demo-Text für die Print- und Schriftindustrie. Lorem Ipsum ist in der Industrie bereits der Standard Demo-Text "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo en.</p><br>-->
                                    <!--                <div class="row">-->
                                    <!--                <div class="col-sm-2">-->
                                    <!--                    <img src="http://demos1.showcasedemos.in/jntuicem2017/html/v1/assets/images/kiara.jpg" class="img-responsive" style="width: 80px">-->
                                    <!--                    </div>-->
                                    <!--                    <div class="col-sm-10">-->
                                    <!--                    <h4><strong>Kiara Andreson</strong></h4>-->
                                    <!--                    <p class="testimonial_subtitle"><span>Chlinical Chemistry Technologist</span><br>-->
                                    <!--                    <span>Officeal All Star Cafe</span>-->
                                    <!--                    </p>-->
                                    <!--                </div>-->
                                    <!--                </div>-->
                                    <!--              </div>-->
                                    <!--            </div>-->
                                    <!--          </div>-->
                                    <!--              <div class="controls testimonial_control pull-right">-->
                                    <!--                <a class="left fa fa-chevron-left btn btn-default testimonial_btn ripplelink" href="#carousel-example-generic"-->
                                    <!--                  data-slide="prev"></a>-->
                                    
                                    <!--                <a class="right fa fa-chevron-right btn btn-default testimonial_btn ripplelink" href="#carousel-example-generic"-->
                                    <!--                  data-slide="next"></a>-->
                                    <!--              </div>-->
                                    <!--        </div>-->
                                            
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
            
        </div>
    </div>
</section>

<div id="cart_data_summary">
    
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
    
    
</div>

<div class="addTocart-bottom-bar" id="addTocart-bottom-bar" style="display:none">
    <a href="<?= site_url('app/homeservice/customer-from');?>" class="full-block-link ripplelink">
        <div class="single-cart-part">
            <?php if(!empty($_SESSION["shopping_cart"])) { 
                $count = count(array_keys($_SESSION["shopping_cart"]));
            }else{ } ?>
               <span class="item-count-circle cart_item_count" style="top: 5px;"><?= $count;?></span>
            </div>
        <div class="single-cart-part">
            <span class="amount-text cart_total_amount">Tk <?php echo number_format($total, 2, ".", ","); ?> </span >
        </div>
        <div class="single-cart-part">
                <span class="next-box">
                    <img src="<?php echo site_url('resource/icons/arrow-right.svg'); ?>"/>
                </span>
            
        </div>
    </a>
</div>

<!-- Modal -->
 <div class="modal fade" id="openClose" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?= $title;?></h4>
        </div>
        <div class="modal-body">
          <p id="close_busy"></p>
        </div>
    </div>
  </div>
</div>
        
        
<script>
$(document).ready(function(){
    //hide and display bottom bar
    var cart_items = Number($('.cart_items').val());
    if(cart_items){
        $("#bottom-nav-controll").css("display","none");
        $("#addTocart-bottom-bar").show();
    }else{
        $("#bottom-nav-controll").css("display","flex");
        $("#addTocart-bottom-bar").hide();
    }
});
    /*
    * This function is used to store data to cart
    * @author:juman 
    * @date:06/09/09 
    */
    function addcartData(category_id,service_id,service_price,service_time){
        var open_close = Number($("#open_close").val());
        var business_busy = Number($("#business_busy").val());
        if(business_busy=="1"){
            var str = $(".item_modify"+service_id).data("cl");
            $("a.modify_icon"+service_id).css("display","none");
            if(str==="noclick"){
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url(); ?>app/homeservice/addcartData",
                    data: {category_id: category_id,service_id:service_id,service_price:service_price,service_time:service_time,qty:"1"},
                    dataType : 'html',
                    cache: false,
                    beforeSend: function() {
                        $(".item_modify"+service_id+" .ajax-loading").css('display','block');
                    },
                    success: function(html){
                        $(".item_modify"+service_id+" .ajax-loading").css('display','none');
                        $("a.modify_icon"+service_id).css("display","block");
                        $("#bottom-nav-controll").css("display","none");
                        $("#addTocart-bottom-bar").show();
                        $("#call_us_btn").hide();
                        $("#cart_btn").show();
                        
                        $(".item_modify"+service_id).data("cl",'clicked');
                        $("a.modify_icon"+service_id).parent().addClass("green_color");
                        $("a.modify_icon"+service_id).html('<i class="fa fa-check-circle"></i>');
                        $("#cart_data_summary").html(html);
                        cart_total = $('.cart_total').val();
                        cart_items = $('.cart_items').val();
                        $('.cart_total_amount').text("Tk "+cart_total);
                        $('.cart_item_count').text(cart_items);
                        
                    } 
                });
            }else{
                removeCurrentData(category_id,service_id);
            }
        }else{
            if(business_busy=="0"){
                $("#openClose").modal("show");
                $("#close_busy").html("We are <span>busy</span> now");
            }else{
                $("#openClose").modal("show");
                $("#close_busy").html("We are <span>closed</span> now");
            }
            
        }
    }
    /*
    * This function is used to remove current service from cart
    * @author:juman 
    * @date:06/09/09 
    */
    function removeCurrentData(category_id,service_id){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(); ?>app/homeservice/removeCurrentData",
            data: {category_id:category_id,service_id:service_id},
            dataType : 'html',
            cache: false,
            beforeSend: function() {
                $(".item_modify"+service_id+" .ajax-loading").css('display','block');
            },
            success: function(html){
                $(".item_modify"+service_id+" .ajax-loading").css('display','none');
                $("a.modify_icon"+service_id).css("display","block");
                $("a.modify_icon"+service_id).html("+");
                $(".item_modify"+service_id).data("cl",'noclick');
                $("#cart_data_summary").html(html);
                cart_total = $('.cart_total').val();
                cart_items = $('.cart_items').val();
                $('.cart_total_amount').text("Tk "+cart_total);
                $('.cart_item_count').text(cart_items);
                $("a.modify_icon"+service_id).parent().removeClass("green_color")
                if(Number(cart_items)>0){
                    $("#bottom-nav-controll").css("display","none");
                    $("#call_us_btn").hide();
                    $("#cart_btn").show();
                    $("#addTocart-bottom-bar").show();   
                }else{
                    $("#addTocart-bottom-bar").hide();
                    $("#bottom-nav-controll").css("display","flex");
                    $("#cart_btn .cart-item").text('0');
                    $("#call_us_btn").show();
                    
                    
                }
            } 
        });
    }
    /*
    * This function is used to add slashes in a single quote srting
    * @author:juman 
    * @date:06/09/09 
    */
    function addslashes(string) {
        return string.replace(/\\/g, '\\\\').
            replace(/\u0008/g, '\\b').
            replace(/\t/g, '\\t').
            replace(/\n/g, '\\n').
            replace(/\f/g, '\\f').
            replace(/\r/g, '\\r').
            replace(/'/g, '\\\'').
            replace(/"/g, '\\"');
    }
</script>
<script src="<?= site_url('resource/app/js/');?>swiped-events.js"></script>
<script>

    window.onload = function() {

        $("#Service").on('swiped-left', function(e) {
            $('.nav-tabs a[href="#About"]').tab('show');
            //e.target.innerHTML = e.type;
        });
        $("#About").on('swiped-left', function(e) {
            $('.nav-tabs a[href="#testimonial"]').tab('show');
            //e.target.innerHTML = e.type;
        });
        $("#About").on('swiped-right', function(e) {
            $('.nav-tabs a[href="#Service"]').tab('show');
            //e.target.innerHTML = e.type;
        });
        $("#testimonial").on('swiped-right', function(e) {
            $('.nav-tabs a[href="#About"]').tab('show');
            //e.target.innerHTML = e.type;
        });
        

        document.addEventListener('swiped-up', function(e) {
            //console.log(e.type);
            //console.log(e.target);
            //e.target.innerHTML = e.type;
        });

        document.addEventListener('swiped-down', function(e) {
            //console.log(e.type);
            //console.log(e.target);
            //e.target.innerHTML = e.type;
        });

    }
</script>