<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">

<section class="home-page-gategory-section" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');min-height: 100vh;">
    <div class="container">
        <br><br><br>
        <?php $this->load->helper('form'); ?>

        <div class="row">   
            <div class="col-md-12">

            <form id="changePasswordForm" autocomplete="off" method="POST" action="<?php echo base_url() ?>app/ChangeForgotPassword">
                <br><br>
                                
                <div style="background: #FFFFFF;padding: 30px 10px 10px 10px;;border-radius: 10px;margin-bottom: 35px;">
                    <div class="group">      
                        <input  type="hidden" name="mobile" id="mobile" required value="<?php echo $mobile; ?>" >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>       
                    <div class="group">      
                        <input  type="password" name="newPassword" id="newPassword"  placeholder="New Password" required >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>
                    
    
                    <div class="group">      
                        <input  type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>
                </div>
                

                <button id="submit_btn" type="submit">Change</button>

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
				<h4 class="header-sts">Ooops!</h4>	
				<p class="md_error_text"></p>
				<button class="btn btn-success close_modal_btn" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
    
    
    if ($("#changePasswordForm").length > 0) {
        
        $.validator.addMethod("nowhitespace", function(value, element) { 

            return value.indexOf(" ") < 0 && value != "";
            
        }, "Remove space Please and type again");
        
    	$("#changePasswordForm").validate({
            rules: {
                
                newPassword:  {
                    required: true,
                    nowhitespace: true,
                },
                confirmPassword:  {
                    required: true,
                    nowhitespace: true,
                    equalTo: '#newPassword',
                },
               
            },
            messages: {

                newPassword: {
                    required: "Password must be enter",
                },
                confirmPassword: {
                    required: "Confirm password must be enter",
                    equalTo: 'Confirm password must be same',
                },
            },
            submitHandler: function(form) {
                var formData = new FormData($('#changePasswordForm')[0]);
                $.ajax({
                type: 'POST',
                dataType: 'json',
                url: baseURL+'app/ChangeForgotPassword',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() { $.LoadingOverlay("show"); },
                complete: function() { $.LoadingOverlay("hide"); },
                success: function(response){
                    if(response.status === 'error'){
                        $('#errorModal').modal('show');
                        $('#errorModal').find('.md_error_text').html(response.msg);
                    }else if(response.status === 'success'){
                        $('#errorModal').modal('show');
                        $('#errorModal').find('.md_error_text').html(response.msg);
                        $('#errorModal').find('.header-sts').html('Done');
                        setInterval(function(){
                            window.location.href= baseURL+'app/userprofile';
                        },3000);
                    }else{
                        $('#errorModal').modal('show');
                        $('#errorModal').find('.md_error_text').html(response.msg);
                    }
                }
                });
            }
        })
      

    }
    
        
    
</script>
