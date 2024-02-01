<link rel="stylesheet" href="<?php echo base_url(); ?>resource/user/css/user.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">
<style>
    .error{font-size:15px;}
</style>

<section class="home-page-gategory-section" style="min-height:100vh;padding-top:30px;background:url('<?php echo base_url() ?>resource/app/icon/bg.png')">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <br>
                <br>
                <form action="<?php echo base_url('app/changeProfile') ?>" method="POST" id="changeProfile">

                    
                    <div style="background: #FFFFFF;padding: 30px 10px 10px 10px;;border-radius: 10px;margin-bottom: 35px;">
                        
                    <div class="group">      
                        <input  type="text"  placeholder="Full Name" name="fullname" id="fullname" value="<?php echo $userProfile[0]->fullname; ?>" required  >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>
                    
                    <div class="group">      
                        <input  type="email"  placeholder="Email" name="email" id="email" value="<?php echo $userProfile[0]->email; ?>" required  >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>
                    
                    
                    <div class="group">
                        <select name="city" class="get-area" id="city">
                            <?php if($cities): ?>
                            <?php foreach($cities as $city): ?>
                            <?php if($userProfile[0]->city!=0): ?>
                            <?php  if($city->city_id==1): ?>
                                <option <?php if($city->city_id == $userProfile[0]->city){ ?>selected="selected"<?php } ?> value="<?php echo $city->city_id; ?>"><?php echo $city->city_name; ?></option>
                            <?php  endif; ?>
                            <?php else: ?>
                                <option value="<?php echo $city->city_id; ?>"><?php echo $city->city_name; ?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>
                    <div class="group">
                        <select name="area" class="append-option" id="area">
                            <option value="">Select Area</option>
                            <?php if($sylhet_areas): ?>
                            <?php foreach($sylhet_areas as $areas): ?>
                                <option <?php if($areas->area_id == $userProfile[0]->area){ ?>selected="selected"<?php } ?> value="<?php echo $areas->area_id; ?>"><?php echo $areas->area_name; ?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>
                    
                    
                    <div class="group">
                        <textarea id="address" name="address" rows="4"><?php echo $userProfile[0]->address; ?></textarea>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label></label>
                    </div>
                    
                    <div class="group">
                        <select name="gender" id="gender">
                            <option value="">Select Gender</option>
                            <option <?php if($userProfile[0]->gender == 1){echo 'selected';} ?> value="1">Male</option>
                            <option <?php if($userProfile[0]->gender == 2){echo 'selected';} ?> value="2">Female</option>
                        </select>
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