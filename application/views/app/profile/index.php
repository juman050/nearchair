<link rel="stylesheet" href="<?php echo base_url(); ?>resource/user/css/user.css">
<link href="https://www.fontify.me/wf/c61fba03e48c28001e90eba4b87ca238" rel="stylesheet" type="text/css">
<?php if($global_business_id): ?>
<script>
    var global_business_id = '<?php echo $global_business_id; ?>';
</script>
<?php else: ?>
<script>
    var global_busines_id = '';
</script>
<?php endif; ?>

<?php if(empty($allbusinesses)): ?>

<section class="userProfileMainSection" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');min-height: 100vh;">
    <div class="container">
        <div class="row">
            
            <h3 style="margin-top:100px;text-align:center;">Sorry :)</h3>
            <h4 style="margin-top:50px;text-align:center;">Your business is pending now</h4>
            
        </div>
    </div>
</section>
<?php else: ?>
<section class="ownerProfileCoverSection" style="background-image:url('<?php echo base_url(); ?>drives/business/<?php echo $allbusinesses[0]->business_img; ?>')">
</section>

<section class="userProfileHeaderSection" style="padding: 8px 0px 0px 0px;height: 130px;">
    <div class="container">

        <div class="row">
            <div class="col-xs-4 text-center">
                
                <div class="avater-abs" style="width: 100%;float: left;height: 100%;position: relative;top: -60px;">
                    <div class="avatar-upload">
                        <form enctype="multipart/form-data" id="ownerChangeProfilePic">
                            <div class="avatar-edit" style="right: 0px;bottom: 0px;">
                                <input name="business_img" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" required="required"/>
                                <label for="imageUpload"></label>
                            </div>
                            <button type="submit" class="btn btn-xs change_btn" style="right: 21%;bottom: -27px;padding: 4px 10px;">Done</button>
                        </form>
                        <div class="avatar-preview" style="background: <?php if($allbusinesses[0]->business_on_off == 1){echo '#12CC94';}else{echo '#FB3569';} ?>">
                            <?php if($owner_image){ ?><div id="imagePreview" style="background-image: url(<?php echo '../drives/business/'.$owner_image; ?>);"></div><?php }else{ ?><div id="imagePreview" style="background-image: url(<?php echo '../drives/users/no-image.png'; ?>"></div><?php } ?></div>
                    </div>
                
                    <p class="turn_status text-center" ><?php if($allbusinesses[0]->business_on_off == 1){echo '<span class="ot_status" style="color:#12CC94">Online</span>';}else{{echo '<span class="ot_status" style="color:#FB3569">Offline</span>';}}  ?></p>
                    <label class="switch" for="checkbox">
                        <input type="checkbox" id="checkbox" class="business_status" <?php if($allbusinesses[0]->business_on_off == 1){echo 'checked';}  ?>/>
                        <div class="slider_switdh round"></div>
                    </label>
                
                </div>

                <script type="text/javascript">
                    var var_business_id = '<?php echo $allbusinesses[0]->business_id;  ?>';
                    jQuery(function($){
                
                        $('.business_status').on('change',function(){
                            var status = $('#checkbox').prop('checked');
                            if(status===true){
                                var sts = 1;
                                $('.avatar-preview').css('background','#12CC94');
                                $('.ot_status').css('color','#12CC94');
                            }else{
                                var sts = 0;
                                $('.avatar-preview').css('background','#FB3569');
                                $('.ot_status').css('color','#FB3569');
                            }
                
                            if(var_business_id)
                            {
                                $.ajax({
                                    url: "<?php echo site_url('app/change_business_status');?>",
                                    dataType: 'html',
                                    method: 'POST',
                                    data: {'sts':sts,'business_id':var_business_id},
                                    success: function(data){
                                        $('.turn_status').html(data);
                                    }
                
                                });
                            }
                
                        });
                
                    });
                </script>
            </div>
            <div class="col-xs-5" style="padding: 0;">
                <p class="owner-bussiness-name"><?php echo $allbusinesses[0]->business_name; ?></p>
            </div>
            
            <?php if($ratings[0]->total_ratings > 0){ ?>
            <div class="col-xs-3" style="padding: 0;">
                <div class="rating">
                    <?php $totalStar = $ratings[0]->total_ratings/$ratings[0]->total_review_ids; ?>
                    <?php for($i = 1; $i<=$totalStar; $i++): ?>
                        <i class="fa fa-star"></i>
                    <?php endfor; ?>
                </div>
                <p class="rating-p"><?php echo $ratings[0]->total_review_ids; ?> Reviews</p>
            </div>
            
            <?php }else{ ?>
            <div class="col-xs-3" style="padding: 0;">
                <div class="rating">
                </div>
                <p class="rating-p">No Reviews</p>
            </div>
            
            <?php } ?>
        </div>
        
    </div>
</section>



<section class="userProfileMainSection" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');min-height: 100vh;">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <div class="main-box-div">
                    <div class="user-icon-box">
                        <a href="<?php echo base_url('app/pendingOrders'); ?>">
                            <div class="single-box-div waves-effect">
                                <img src="<?php echo base_url() ?>resource/owner/icon/pending.svg"/>
                                <div class="box-title-new">
                                    <p>Pending</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="user-icon-box">
                        <a href="<?php echo base_url('app/ownerOrders'); ?>">
                            <div class="single-box-div waves-effect">
                                <img src="<?php echo base_url() ?>resource/owner/icon/history.svg"/>
                                <div class="box-title-new">
                                    <p>History</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!--<div class="user-icon-box">-->
                    <!--    <a href="<?php echo base_url('app/ownerAddService'); ?>">-->
                    <!--        <div class="single-box-div waves-effect">-->
                    <!--            <img src="<?php echo base_url() ?>resource/owner/icon/gallery.svg"/>-->
                    <!--            <div class="box-title-new">-->
                    <!--                <p>Add Service</p>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </a>-->
                    <!--</div>-->
                    <div class="user-icon-box">
                        <a href="<?php echo base_url('app/ownerServiceList'); ?>">
                            <div class="single-box-div waves-effect">
                                <img src="<?php echo base_url() ?>resource/owner/icon/service_list.svg"/>
                                <div class="box-title-new">
                                    <p>Service List</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="user-icon-box">
                        <a href="<?php echo base_url('app/ownerBusiness'); ?>">
                            <div class="single-box-div waves-effect">
                                <img src="<?php echo base_url() ?>resource/owner/icon/gallery.svg"/>
                                <div class="box-title-new">
                                    <p>Business Info</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!--<div class="user-icon-box">-->
                    <!--    <a href="<?php echo base_url('app/ownerGallery'); ?>">-->
                    <!--        <div class="single-box-div waves-effect">-->
                    <!--            <img src="<?php echo base_url() ?>resource/owner/icon/gallery.svg"/>-->
                    <!--            <div class="box-title-new">-->
                    <!--                <p>Photos</p>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </a>-->
                    <!--</div>-->
                    <div class="user-icon-box">
                        <a href="tel:01746150145">
                            <div class="single-box-div ripplelink">
                                <img src="<?php echo base_url() ?>resource/owner/icon/support.svg"/>
                                <div class="box-title-new">
                                    <p>Support</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
<?php endif; ?>
<script type="text/javascript" src="<?php echo base_url(); ?>/resource/owner/js/pages/profile.js"></script>
