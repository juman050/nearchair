<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">
<section class="home-page-gategory-section" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');min-height: 100vh;">
    <div class="container">
        <br><br><br>
        <?php $this->load->helper('form'); ?>
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        <div class="row">   
            <div class="col-md-12">
                <?php
                $error = $this->session->flashdata('error');
                if($error)
                {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $error; ?>                    
                    </div>
                <?php }
                $success = $this->session->flashdata('success');
                if($success)
                {
                    ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $success; ?>                    
                    </div>
                <?php } ?>
                <form action="<?php echo base_url('app/checkForgetVerifyCode'); ?>" method="get" id="forgotPasswordForm" autocomplete="off">
                    <br>
                    <br>
                    <br>
                    <div style="background: #FFFFFF;padding: 30px 10px 10px 10px;;border-radius: 10px;margin-bottom: 35px;">
                    <div class="group">
                        <input type="mobile" placeholder="+88" value="+88" style="width: 12%;float: left;padding-right: 0px;" disabled="true">
                        <input type="mobile" placeholder="01xxxxxxxxx" name="mobile" id="mobile" required style="width: 87%;">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>

                    <input type="hidden"  name="otp" value="ncpass" required  >
                    </div>
                    <button id="submit_btn" class="ripplelink" type="submit">Submit</button>

                </form>
                <br>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url(); ?>resource/user/js/forgotPassword.js" type="text/javascript"></script>
