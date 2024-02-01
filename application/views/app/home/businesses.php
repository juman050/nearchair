        <div class="location-manager">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-xs-8">
                        <div class="location-marker-div">
                            <img width="20px" src="<?php echo site_url('resource/icons/map-pin.svg')?>"/>
                        </div>
                        <div class="current-location-text-div">
                          <span class="location-current-text">Your current location</span>
                          <?php 
                             $city_id="";
                             $area_id="";
                        	 if(get_cookie('city')!==null){ $city_id = get_cookie('city'); }
                        	 if(get_cookie('area')!==null){$area_id = get_cookie('area');}
                        	 $locaText = "";
                        	 if($area_id!==""){ $locaText = getAreaName($area_id); }else{ $locaText="Sylhet"; }
                           ?>
                          <strong class="current-location"><?=$locaText;?></strong>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-4">
                        <div class="location-change-div">
                          <a class="btn-location ripplelink" id="changeLocation">Change</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="single-salon-section">
            <div class="container">
                <div class="row">
                    <?php if(!empty($business_list)){ foreach($business_list as $business){?>
                    <div class="col-md-4 col-sm-3 col-xs-6 responsive-width">
                        <?php 
                            $st_time = $business->opening_time.":00";
                            $end_time = $business->closing_time.":00";
                            $tz = 'Asia/Dhaka';
                            $tz_obj = new DateTimeZone($tz);
                            $today = new DateTime("now", $tz_obj);
                            $cur_time = $today->format('H:i:s');
                            $close_class='';
                            if($st_time <= $cur_time && $end_time >= $cur_time){
                                //echo "WE ARE OPEN NOW !!";
                                $open_close = "1";
                                $open_close_text="FREE";
                            }else{
                                 //echo "WE ARE CLOSE  NOW !!";
                                 $open_close = "0";
                                 $close_class = 'business_closed';
                                 $open_close_text=date('h:i A', strtotime($end_time));
                            }
                        ?>
                        <a href="<?php echo base_url('app/business/'.$business->business_slug); ?>" class="single-salon-box margin-toP ripplelink  <?=$close_class;?>">
                            <?php if($open_close=='0'){ ?>
                            <div class="closed-overlay">
                                <div class="closed-overlay-label">ADVANCED APPOINTMENT</div>
                            </div>
                            <?php } ?>
                            <div class="salon-box-thumb salon-cover-img bg lazy" data-src="<?php echo site_url('drives/business/'.$business->business_img)?>">
                                <!--<span class="text"><?=$business->business_name;?></span>-->
                                <div class="tag-container">
                                    
                                    <?php
                                        $businessOffer = getBusinessOffer($business->business_id);    
                                        if(!empty($businessOffer)){
                                            echo '<span class="multi-tag"> '.$businessOffer->discount." % OFF </span>";
                                        }
                                    ?>
                                    
                                    
                                </div>
                                <?php 
                                if($open_close=="0"){?>
                                    <span class="badge-info"><?=$open_close_text;?>
                                       <span class="label">Closed until</span>
                                    </span>
                                <?php } ?>
                                
                            </div>
                            <div class="bottom-content">
                                <h4 class="salon-name"><?=$business->business_name;?></h4>
                                
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
                                <p class="salon-address"> <?=$business->address;?></p>
                            </div>
                        </a >
                    </div>
                    <?php } }else{?>
                    <div class="not_found">
                        <img src="<?= site_url();?>resource/app/images/not_found.svg" class="not_found_img"/>
                    </div>
                    
                    <h3 class="not-found-title">Sorry!</h3>
                    <?php if(isset($nc_location)){?>
                        <p class="not-found-text">We don't have any salon/parlor in <?=$locaText;?> yet. We will be available there soon!</p>
                    <?php }else{ ?>
                        <p class="not-found-text">Business not found.</p>
                        
                    <?php } } ?>
                    
                </div>
            </div>
        </section>
        
