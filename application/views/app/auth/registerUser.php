<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">
<link href="https://www.fontify.me/wf/0ccdf727dfdc4f72f70f869eb7c5d8e9" rel="stylesheet" type="text/css">
<link href="https://www.fontify.me/wf/c61fba03e48c28001e90eba4b87ca238" rel="stylesheet" type="text/css">
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
                <h3 class="form-title" style="font-family:font92726;color:#00B2E5;font-size: 30px;">Let's get started</h3>
                <p class="form-sub-title" style="font-family:font92726;color:#717171;font-size: 18px;">Create an account</p>
                <form action="<?php echo base_url('app/insertUser'); ?>" method="get" id="registerForm" autocomplete="off">

                    <div style="background: #FFFFFF;padding: 30px 10px 10px 10px;;border-radius: 10px;margin-bottom: 35px;">
                            
                        <div class="group">      
                            <input  type="text"  placeholder="Full Name" name="fullname" id="fullname" required  >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
                        
                        <div class="group">
                            <input type="text" placeholder="Mobile" value="+88" style="width: 12%;float: left;padding-right: 0px;" disabled="true">
                            <input type="text" placeholder="01xxxxxxxxx" name="mobile" id="mobile" required style="width: 88%;">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>

                        <div class="group">      
                            <input type="password" placeholder="Password" name="password" id="password" required  >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>

                        
                        <input type="hidden"  name="otp" value="ncotp" required  >
                    
                    </div>
                    
                    <button id="submit_btn" class="ripplelink" type="submit"  style="max-width: 70%;border-radius: 29px;margin-bottom:10px;font-size:18px;">REGISTER</button>

                </form>
                <br>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url(); ?>resource/user/js/loginRegister.js" type="text/javascript"></script>
