<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">
<link href="https://www.fontify.me/wf/0ccdf727dfdc4f72f70f869eb7c5d8e9" rel="stylesheet" type="text/css">
<link href="https://www.fontify.me/wf/c61fba03e48c28001e90eba4b87ca238" rel="stylesheet" type="text/css">


<section class="home-page-gategory-section" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');min-height: 100vh;">
    <div class="container">
        <br><br><br>
        <?php $this->load->helper('form'); ?>

        <div class="row">   
            <div class="col-md-12">
                <h3 class="form-title" style="font-family:font92726;color:#00B2E5;font-size: 30px;">Welcome back </h3>
                <p class="form-sub-title"style="font-family:font92726;color:#717171;font-size: 18px;">Please log in to continue</p>
                <form id="loginForm" autocomplete="off" >
                    <div style="background: #FFFFFF;padding: 30px 10px 10px 10px;;border-radius: 10px;margin-bottom: 35px;">
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
                        
                    </div>
                    
                    
                    <button id="submit_btn" type="submit" class="ripplelink" style="max-width: 70%;border-radius: 29px;margin-bottom:10px;font-size:18px;">LOG IN</button>
                    <p class="registerLink">Don't have any account ? <a href="<?php echo base_url('app/registerUser'); ?>" class="">Register</a></p>
                    <p class="registerLink"><a href="<?php echo base_url('app/forgotPassword'); ?>" class="">Forgot Password</a></p>
                </form>

            </div>
        </div>
    </div>
</section>

<!-- Modal HTML -->
<div id="errorModal" class="modal fade">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-body text-center">
				<h4>Ooops!</h4>	
				<p class="md_error_text"></p>
				<button class="btn btn-success close_modal_btn" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>resource/user/js/loginRegister.js" type="text/javascript"></script>