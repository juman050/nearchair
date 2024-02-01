
        <header style="position: relative;">
            <div class="tag-container" >
                                    
                    <?php
                        $businessOffer = getBusinessOffer($business->business_id);    
                        if(!empty($businessOffer)){
                            echo '<span class="multi-tag"> '.$businessOffer->offer_title."</span>";
                        }
                    ?>
                    
                    
                </div>
            <div class="header-slider owl-carousel">
                <?php if(!empty($business_gallery)){ foreach($business_gallery as $gallery){?>
                <div class="item slider-img" style="background-image: url(<?php echo site_url('resource/app/images/gallery/'.$gallery->image)?>);">
                    <div class="overlay">
                        <div class="container">
                            <div class="row">  
                            </div>
                        </div>
                    </div>
                    
                </div>
                <?php } }else{?>
                    <div class="alert alert-danger">Data not found.</div>
                <?php } ?>
                
            </div> 
            
        </header>
        
        <section class="profile-section" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');min-height: 100vh;padding-top: 0px;">
            <div class="container">
                <div class="row" style="background:#fff">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="barber-prof">
                            <?php 
                            $st_time = $business->opening_time.":00";
                            $end_time = $business->closing_time.":00";
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
                            <h2 class="barber-name"><?= $business->business_name;?></h2>
                            <div class="bottom-widget-wrapper">
                                <div class="widget">
                                    <img height="16px" src="<?php echo site_url('resource/icons/noun_salon chair_266981.svg');?>" /> <?=$business->total_chairs;?>
                                </div>
                                <div class="widget">
                                    <span class='widget-text'>AC</span>
                                </div>   
                                   
                                <div class="widget">
                                    <span class='widget-text'>
                                        <?php 
                                        if($business->business_on_off==0 && $open_close==1){ 
                                            echo '<span style="color:#ff6aa5">BUSY</span>';
                                            
                                        }else if($business->business_on_off==1 && $open_close==1){
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
                                    $rating_avg = ratingAvg($business->business_id);
                                    ?>
                                    <?=$rating_avg;?>/5
                                    <span class="review-count">
                                        (<?php echo totalReview($business->business_id);?>)
                                    </span>
                                </div>
                            </div>
                            <input type="hidden" id="open_close" value="<?=$open_close;?>"/>
                            <input type="hidden" id="business_busy" value="<?= $business->business_on_off;?>"/>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                        <div class="tabmenu-wrapper-div">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs custom-nav-tabs" role="tablist">
                                <li role="presentation" class="active custom-navtab-item "><a href="#Service" aria-controls="service" role="tab" data-toggle="tab" class="service">Services</a></li>
                                <li role="presentation" class="custom-navtab-item "><a href="#About" aria-controls="about" role="tab" data-toggle="tab" class="about">About</a></li>
                                <li role="presentation" class="custom-navtab-item "><a href="#Review" aria-controls="review" role="tab" data-toggle="tab" class="review">Review</a></li>
                            </ul>
                            <div class="col-md-12 col-sm-12 col-xs-12 pad-10">
                            <!-- Tab panes -->
                            <div class="tab-content custom-tab-content">
                                <div role="tabpanel" class="tab-pane custom-tab-panel active" id="Service">
                                    <div class="panel-wrapper">
                                        <div class="panel-group wrap custom-panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                           
                                        <?php if(!empty($categories)){ $count=0; foreach ($categories as $category){ $count++; ?>    
                                            <?php if(getTotalService($category->category_id,$business->business_id)>0){ ?>
                                            <div class="panel custom-panel">
                                                <div class="panel-heading" role="tab" id="headingOne">
                                                    <h4 class="panel-title">
                                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#cat<?=$category->category_id;?>" aria-expanded="true" aria-controls="cat<?=$category->category_id;?>">
                                                          <?=$category->category_name;?> <!--(// echo getTotalService($category->category_id,$business->business_id) ;)-->
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="cat<?=$category->category_id;?>" class="panel-collapse collapse in service_list_div" role="tabpanel" aria-labelledby="headingOne">
                                                  <div class="panel-body">
                                                    <ul class="item list-unstyled hair-ul">
                                                        <?php $get_service = getBusinessServiceUnderCategory($category->category_id,$business->business_id) ;?>
                                                        <?php if(!empty($get_service)){ $remove_border_first=0; foreach ($get_service as $service){$remove_border_first++; ?>
                                                            <?php
                                                            $old_price="";
                                                            
                                                            $price = $service->service_price;
                                                            $offer_price="";
                                                            
                                                            if(!empty($businessOffer)){
                                                                
                                                                $discount = $businessOffer->discount;
                                                                if($businessOffer->offer_type=="all"){
                                                                    $old_price=$service->service_price;
                                                                    $offer_price = $price - ($price * ($discount/100)); 
                                                                    $price = $offer_price;
                                                                    
                                                                }else{
                                                                    $service_ids = array();
                                                                    $service_ids = $businessOffer->service_ids;
                                                                    $ids=array();
                                                                    $ids=explode(",",$service_ids); 
                                                                   
                                                                    $a = 0;
                                                                    if($businessOffer->offer_type=="included"){
                                                                        if(in_array($service->service_id, $ids)){
                                                                            $old_price=$service->service_price;
                                                                            $offer_price = $price - ($price * ($discount/100)); 
                                                                            $price = $offer_price;
                                                                        }
                                                                       
                                                                    }else{
                                                                        if(!in_array($service->service_id, $ids)){
                                                                            $old_price=$service->service_price;
                                                                            $offer_price = $price - ($price * ($discount/100)); 
                                                                            $price = $offer_price;
                                                                        }
                                                                    }
                                                                }
                                                                
                                                                
                                                            }else{
                                                                if($service->service_discount_price>0){ 
                                                                $price = $service->service_discount_price; 
                                                                $old_price = $service->service_price; 
                                                               }else{ $price = $service->service_price; } 
                                                            }
                                                        $remove_border_style="";
                                                        if($remove_border_first==1) {
                                                            $remove_border_style="border-top:0;";
                                                        }
                                                        ?>
                                                        <li style="<?=$remove_border_style;?>" class="item-list item_modify<?php echo $service->service_id.$service->business_id?> ripplelink" data-cl="<?php echo checkServiceCart($service->service_id,$service->business_id);?>" onclick="addcartData('<?php echo $category->category_id?>','<?php echo $service->service_id?>','<?php echo $price?>','<?php echo $service->service_time?>','<?php echo $service->business_id?>');return false;">
                                                            <span class="item-name" style="width:65%"><?= $service->service_name;?>  </span>
                                                            <!--<span class="item-time"><i class="fa fa-clock-o"></i> <?= $service->service_time;?></span>-->
                                                            <span class="item-price">
                                                                <?php if($old_price!==""){ echo '<strike style="font-size:85%"><small class="text-danger"> Tk '.$old_price.'</small></strike> '; } ?>
                                                                Tk <?php echo $price; ?> 
                                                            </span>
                                                            <span class="add-to-cart <?php if(checkServiceCart($service->service_id,$service->business_id)=='clicked'){ echo 'green_color';}?>"><a href="" class="modify_icon<?php echo $service->service_id.$service->business_id?>">
                                                                <?php if(checkServiceCart($service->service_id,$service->business_id)=='clicked'){ echo '<i class="fa fa-check-circle"></i>';}else{echo '+';}?>
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
                                    <div class="about-us-content">
                                        <p class="p-text"  style="text-align: center;"><span style="color: #202023;font-weight: 600;font-size: 18px;text-align:center">OPENING HOURS <?= $business->opening_time." - ".$business->closing_time;?></span></p>
                                        <p class="p-text" style="color:#202023;font-weight: 400;font-size: 18px;line-height:24px"><?= $business->address;?></p>
                                        <div id="googleMap" style="width:100%;height: 180px;margin-top:10px">
                                            <iframe src="<?= $business->business_location;?>" frameborder="0" style="border:0; width: 100%;height: auto;" allowfullscreen=""></iframe>
                                        </div>
                                        
                                        <p class="p-text"><?= $business->business_description;?></p>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane custom-tab-panel review-tab" id="Review">
                                    <div class="review-rating-wrapper" style="width: 100%;" id="review-content-div">
                                       
                                        <?php if(!empty($business_reviews)){?>
                                        <!--<ul class="list-unstyled list-inline rating-top-bar">-->
                                        <!--    <li class="rating-list active">-->
                                        <!--        <a href="#" class="rating-btn ">All</a>-->
                                        <!--    </li>-->
                                        <!--    <li class="rating-list">-->
                                        <!--        <a href="#" class="rating-btn">5<i class="fa fa-star"></i></a>-->
                                        <!--    </li>-->
                                        <!--    <li class="rating-list">-->
                                        <!--       <a href="#" class="rating-btn">4<i class="fa fa-star"></i></a>-->
                                        <!--    </li>-->
                                        <!--    <li class="rating-list">-->
                                        <!--        <a href="#" class="rating-btn">3<i class="fa fa-star"></i></a>-->
                                        <!--    </li>-->
                                        <!--    <li class="rating-list">-->
                                        <!--        <a href="#" class="rating-btn">2<i class="fa fa-star"></i></a>-->
                                        <!--    </li>-->
                                        <!--    <li class="rating-list">-->
                                        <!--        <a href="#" class="rating-btn">1<i class="fa fa-star"></i></a>-->
                                        <!--    </li>-->
                                        <!--</ul>-->
                                        <div class="review-rating-content-div" >
                                            <!--<div class="rating-count-big">-->
                                            <!--    <p><span class="user">(<?php echo totalReview($business->business_id);?>) <i class="fa fa-user-o"></i></span></p>-->
                                            <!--</div>-->
                                            
                                            <ul class="list-unstyled client-rating" id="ul-review">
                                                <?php foreach($business_reviews as $review){?>
                                                
                                                <li class="single-raing reviews">
                                                    <div class="col-md-12 col-sm-12 col-xs-12 p-none">
                                                        <div class="row">
                                                            <div class="col-md-3 col-sm-3 col-xs-3 ">
                                                                <div class="cl-img">
                                                                    <?php 
                                                                    if($review->image==""){?>
                                                                        <img src="<?php echo site_url('resource/app/images/avatar.png');?>" alt="">
                                                                    <?php }else{ ?>
                                                                    <img src="<?php echo site_url('drives/users/'); echo $review->image;?>" alt="">
                                                                    <?php } ?>
                                                                    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9 col-sm-9 col-xs-9 ">
                                                               <div class="content">
                                                                    <h4><?= $review->fullname;?></h4>
                                                                    <div class="rating">
                                                                        <?php for($rating=0;$rating<$review->rating;$rating++){?>
                                                                            <i class="fa fa-star"></i>
                                                                        <?php } ?>
                                                                        <span>(<?php echo time_ago($review->createdDtm);?> ago)</span>
                                                                    </div>
                                                                </div>
                                                                <p class="p-text"><?=$review->review_text;?> </p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </li>
                                                
                                                <?php } ?>
                                                
                                                <?php if($reviews_count>3){?>
                                                <li>
                                                    <h3 class="load-more">Load More</h3>
                                                    <input type="hidden" id="row" value="0">
                                                </li>
                                                <?php } ?>
                                                
                                                
                                                
                                            </ul>
                                        </div>  
                                        <?php }?> 
                                        <input type="hidden" id="allreviews" value="<?php echo $reviews_count; ?>">
                                         <input type="hidden" id="business_id" value="<?= $business->business_id;?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <div id="cart_data_summary">
            <?php $cart_data = $this->cart->contents(); if(is_array($cart_data)) { ?>
            <?php  $count = count($this->cart->contents()); if (!$count) {  $count = 0; } ?>
            <input type="hidden" value="<?php echo $count ?>" class="cart_items">
            
            <?php $subtotal = 0; $total = 0; 
            foreach($cart_data as $cart) { ?>
            <?php $subtotal = $subtotal + ($cart['qty'] * $cart['price']); ?>
            <?php } ?>
            <?php }else{ } ?>
            <?php $total = $subtotal;?>
            <input type="hidden" class="cart_total" value="<?php echo number_format($total, 2, ".", ","); ?>">
        </div>
        
        <div class="addTocart-bottom-bar" id="addTocart-bottom-bar" style="display:none">
            <?php 
                if(get_cookie('user_id')!==null){
                    $url = site_url('app/checkout');
                }else{
                    $url = site_url('app/user');
                }
            ?>
            <a href="<?php echo $url;?>" class="full-block-link ripplelink">
                <div class="single-cart-part">
                    <?php  $count = count($this->cart->contents());
                        if (!$count) { $count = 0; }
                    ?>
                    <span class="item-count-circle cart_item_count"><?= $count;?></span>
                </div>
                <div class="single-cart-part">
                    <span class="amount-text cart_total_amount">Tk <?php $cart_data = $this->cart->contents(); if(is_array($cart_data)) { 
                        $total = 0; foreach($cart_data as $cart) { 
                        $total += $cart['price'] * $cart['qty'];
                     } ?> 
                     <?php echo number_format($total, 2, ".", ","); ?> <?php } ?></span>
                    
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
                  <h4 class="modal-title"><?= $business->business_name;?></h4>
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
        * This function is used load more reviews
        * @author:juman 
        * @date:11/09/2019 
        */
        $(document).ready(function(){

            // Load more data
            $('.load-more').click(function(){
                var row = Number($('#row').val());
                var business_id = Number($('#business_id').val());
                var allcount = Number($('#allreviews').val());
                var rowperpage = 3;
                row = row + rowperpage;
        
                if(row <= allcount){
                    $("#row").val(row);
        
                    $.ajax({
                        url: '<?php echo site_url("app/loadMoreReviews");?>',
                        type: 'post',
                        data: {row:row,business_id:business_id},
                        beforeSend:function(){
                            $(".load-more").text("Loading...");
                        },
                        success: function(response){
        
                            // Setting little delay while displaying new content
                            setTimeout(function() {
                                // appending posts after last post with class="post"
                                $(".reviews:last").after(response).show().fadeIn("slow");
        
                                var rowno = row + rowperpage;
        
                                // checking row value is greater than allcount or not
                                if(rowno > allcount){
        
                                    // Change the text and background
                                    $(".load-more").text(" ");
                                    //$('.load-more').css("background","#ffa500");
                                }else{
                                   $('.load-more').text("Load more");
                                }
                            }, 2000);
        
                        }
                    });
                }else{
                    $('.load-more').text("Loading...");
        
                    // Setting little delay while removing contents
                    setTimeout(function() {
        
                        // When row is greater than allcount then remove all class='post' element after 3 element
                        $('.reviews:nth-child(3)').nextAll('.reviews').remove();
        
                        // Reset the value of row
                        $("#row").val(0);
        
                        // Change the text and background
                        $('.load-more').text("Load more");
                        //$('.load-more').css("background","#15a9ce");
                        
                    }, 2000);
        
        
                }
        
            });
            
            return false;
        
        });
        /*
        * This function is used to store data to cart
        * @author:juman 
        * @date:06/09/09 
        */
        function addcartData(category_id,service_id,service_price,service_time,business_id){
            var open_close = Number($("#open_close").val());
            var business_busy = Number($("#business_busy").val());
            if(business_busy=="1"){
                var str = $(".item_modify"+service_id+business_id).data("cl");
                $("a.modify_icon"+service_id+business_id).css("display","none");
                if(str==="noclick"){
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url(); ?>app/addcartData",
                        data: {category_id: category_id,service_id:service_id,service_price:service_price,service_time:service_time,qty:"1",business_id:business_id},
                        dataType : 'html',
                        cache: false,
                        beforeSend: function() {
                            $(".item_modify"+service_id+business_id+" .ajax-loading").css('display','block');
                        },
                        success: function(html){
                            $(".item_modify"+service_id+business_id+" .ajax-loading").css('display','none');
                            $("a.modify_icon"+service_id+business_id).css("display","block");
                            $("#bottom-nav-controll").css("display","none");
                            $("#addTocart-bottom-bar").show();
                            $("#call_us_btn").hide();
                            $("#cart_btn").show();
                            
                            $(".item_modify"+service_id+business_id).data("cl",'clicked');
                            $("a.modify_icon"+service_id+business_id).parent().addClass("green_color");
                            $("a.modify_icon"+service_id+business_id).html('<i class="fa fa-check-circle"></i>');
                            $("#cart_data_summary").html(html);
                            cart_total = $('.cart_total').val();
                            cart_items = $('.cart_items').val();
                            $('.cart_total_amount').text("Tk "+cart_total);
                            $('.cart_item_count').text(cart_items);
                            
                        } 
                    });
                }else{
                    removeCurrentData(category_id,service_id,business_id);
                }
            }else{
                if(business_busy=="0"){
                    $("#openClose").modal("show");
                    $("#close_busy").html("We are <span>busy</span> now");
                }else{
                   // $("#openClose").modal("show");
                    //$("#close_busy").html("We are <span>closed</span> now");
                }
                
            }
        }
        /*
        * This function is used to remove current service from cart
        * @author:juman 
        * @date:06/09/09 
        */
        function removeCurrentData(category_id,service_id,business_id){
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>app/removeCurrentData",
                data: {category_id:category_id,service_id:service_id,business_id:business_id},
                dataType : 'html',
                cache: false,
                beforeSend: function() {
                    $(".item_modify"+service_id+business_id+" .ajax-loading").css('display','block');
                },
                success: function(html){
                    $(".item_modify"+service_id+business_id+" .ajax-loading").css('display','none');
                    $("a.modify_icon"+service_id+business_id).css("display","block");
                    $("a.modify_icon"+service_id+business_id).html("+");
                    $(".item_modify"+service_id+business_id).data("cl",'noclick');
                    $("#cart_data_summary").html(html);
                    cart_total = $('.cart_total').val();
                    cart_items = $('.cart_items').val();
                    $('.cart_total_amount').text("Tk "+cart_total);
                    $('.cart_item_count').text(cart_items);
                    $("a.modify_icon"+service_id+business_id).parent().removeClass("green_color")
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
            $('.nav-tabs a[href="#Review"]').tab('show');
            //e.target.innerHTML = e.type;
        });
        $("#About").on('swiped-right', function(e) {
            $('.nav-tabs a[href="#Service"]').tab('show');
            //e.target.innerHTML = e.type;
        });
        $("#Review").on('swiped-right', function(e) {
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
