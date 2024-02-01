<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">

<section class="home-page-gategory-section" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');min-height: 100vh;">
    <div class="container">
        <br><br><br>
        <div class="row">
            
            <div class="col-md-12">
                <?php if($otp == 'failed'){ ?>
                    <p class="text-center">Code Doesn't match</p>
                <?php } ?>
          
            </div>
            
            <div class="col-md-12">

            <form id="verifyForm" autocomplete="off" method="GET" action="<?php echo base_url() ?>app/forgotChangePassword">
                <br><br>
                <input  type="hidden" name="mobile" id="mobile" required value="<?php echo $mobile; ?>" >
                <div style="background: #FFFFFF;padding: 30px 10px 10px 10px;;border-radius: 10px;margin-bottom: 35px;">
                    <div class="group">      
                        <input type="text" placeholder="Code" name="code" id="code" value="<?php echo is_numeric ($otp) ? $otp : ''; ?>" required  >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>
                </div>
            
                <input  type="hidden" name="verified" id="area" required value="passforgot" >
                <button id="submit_btn" type="submit">Verify</button>
                
                <p class="registerLink"><a href="resend" class="">Resend Code</a></p>

            </form>
            <br>
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
