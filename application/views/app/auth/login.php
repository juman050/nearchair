<link rel="stylesheet" href="<?php echo base_url(); ?>resource/owner/css/login.css">
<section class="home-page-gategory-section">
    <div class="container">
        <br><br><br>
        <?php $this->load->helper('form'); ?>

        <div class="row">   
            <div class="col-md-12">
                <img class="login-register-image" src="<?php echo base_url(); ?>drives/logo/app/gra-1.png" style="height: auto;margin-bottom:50px;"/>
                <form id="loginForm" autocomplete="off">
                    <div class="group">      
                        <input  type="email"  placeholder="Email" name="email" id="email" required  >
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

                    <button id="submit_btn" type="submit">Sign In</button>
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

<script type="text/javascript">
    jQuery(function($){
        if ($("#loginForm").length > 0) {
            $("#loginForm").validate({
              
                rules: {
                    email:  {
                        required: true,
                        email: true,
                    },
                    password:  {
                        required: true,
                    },
                },
                messages: {
                    email: {
                        required:"Email Must Be Fill-Up.",
                        email: 'Email should be valid',
                    },
                    password: {
                        required: "Password Must Be Fill-Up",
                    },
                },
                submitHandler: function(form) {
                    var formData = new FormData($('#loginForm')[0]);
                    $.ajax({
                      type: 'POST',
                      dataType: 'json',
                      url: baseURL+'app/loginOwner',
                      data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            if(response.status === 'error'){
                                $('#errorModal').modal('show');
                                $('#errorModal').find('.md_error_text').html(response.msg);
                            }else if(response.status === 'success'){
                                window.location.href= baseURL+'app/successProfile'+'/'+response.ownerid+'oid';
                            }else{
                                $('#errorModal').modal('show');
                                $('#errorModal').find('.md_error_text').html(response.msg);
                            }
                          
                        
                      }
                    });
                }
            })
        }
    });

</script>
