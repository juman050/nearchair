<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>resource/user/css/user.css">
<section class="home-page-gategory-section" style="min-height:100vh;padding-top:50px;background:url('<?php echo base_url() ?>resource/app/icon/bg.png');">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <br>
                <br>
                <form action="<?php echo base_url('app/changePassword') ?>" method="POST" id="changePassword">
                    <div style="background: #FFFFFF;padding: 30px 10px 10px 10px;;border-radius: 10px;margin-bottom: 35px;">
                    <input type="hidden" name="user_id" id="user_id" class="form-control" value="<?php echo $user_id;  ?>" required="required">

                    <div class="group">      
                        <input  type="password"  placeholder="Old Password" name="oldPassword" id="oldPassword" required  >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>
                    <div class="group">      
                        <input  type="password"  placeholder="New Password" name="newPassword" id="newPassword" required  >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>
                    </div>

                    
                    <button id="submit_btn" type="submit" class="changePassword">Update</button>
                </form>
            </div>
            
        </div>
    </div>
</section>

<script src="<?php echo base_url(); ?>resource/user/js/user.js" type="text/javascript"></script>

<?php $this->load->view('app/user/modals'); ?>