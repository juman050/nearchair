<link rel="stylesheet" href="<?php echo base_url(); ?>resource/user/css/user.css">
<link href="https://www.fontify.me/wf/c61fba03e48c28001e90eba4b87ca238" rel="stylesheet" type="text/css">

<section class="userProfileHeaderSection">
    <div class="container">
        <div class="row">

            <div class="col-md-5 col-xs-5 col-xs-5">
               
                <div class="right_div">
                    <div class="avatar-upload">
                        <form enctype="multipart/form-data" id="changeProfilePic">
                            <div class="avatar-edit">
                               <input name="image" type='file' id="imageUpload" accept="image/*" required="required"/>
                              
                                <label for="imageUpload"></label>
                            </div>
                            <button type="submit" class="btn btn-xs change_btn">Done</button>
                        </form>
                        <div class="avatar-preview">
                            <?php if($userProfile[0]->image!==""){ ?>
                                <div id="imagePreview" style="background-image: url('<?php echo '../drives/users/'.$userProfile[0]->image; ?>');"></div>
                            <?php }else{ ?>
                                <div id="imagePreview" style="background-image: url('<?php echo '../drives/users/no-image.png'; ?>'"></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-7 col-sm-7 col-xs-7" style="padding-left: 0px;">
                <div class="left_div">
                    <h2 class="name"><?php echo $fullname; ?></h2>
                    <h3 class="mobile">+88<?php echo $userMobile; ?></h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="userProfileMainSection"  style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <div class="main-box-div">
                    <div class="user-icon-box">
                        <a href="<?php echo base_url('app/userProfileOrderList'); ?>">
                            <div class="single-box-div ripplelink">
                                <img src="<?php echo base_url() ?>resource/user/icons/my_booking.svg"/>
                                <div class="box-title-new">
                                    <p>My Booking</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="user-icon-box">
                        <a href="<?php echo base_url('app/userProfileChangePassword'); ?>">
                            <div class="single-box-div ripplelink">
                                <img src="<?php echo base_url() ?>resource/user/icons/change_password.svg"/>
                                <div class="box-title-new">
                                    <p>Change Password</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="user-icon-box">
                        <a href="<?php echo base_url('app/userProfileView'); ?>">
                            <div class="single-box-div ripplelink">
                                <img src="<?php echo base_url() ?>resource/user/icons/update_profile.svg"/>
                                <div class="box-title-new">
                                    <p>Update Profile</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="user-icon-box">
                        <a href="tel:<?=$system_data->nearchair_mobile?>">
                            <div class="single-box-div ripplelink">
                                <img src="<?php echo base_url() ?>resource/user/icons/support.svg"/>
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

<script src="<?php echo base_url(); ?>resource/user/js/user.js" type="text/javascript"></script>

<?php $this->load->view('app/user/modals'); ?>