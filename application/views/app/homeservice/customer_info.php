<?php
if(get_cookie('fullname')!==null){$fullname = get_cookie('fullname');}else{$fullname =""; };
if(get_cookie('mobile')!==null){$mobile = get_cookie('mobile');}else{$mobile =""; };
if(get_cookie('area')!==null){$area_id=get_cookie('area');}else{$area_id=""; };
$area_id = intval($area_id);
?>
<section class="customer-info-section" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');min-height: 100vh;padding-top: 0px;">
    <div class="container">
        
        <form action="<?php echo base_url('app/homeservice/checkout'); ?>" method="GET" id="cusomerInfo" autocomplete="off" style="padding-top: 35px;">
            <div class="form-pad-box">
                <div class="group">      
                    <input  type="text"  placeholder="Full Name" name="customer_name" id="customer_name" value="<?=$fullname;?>" required  >
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label></label>
                </div>
                
                <div class="group">
                    <input type="customer_contact" placeholder="+88" value="+88" style="width: 12%;float: left;padding-right: 0px;">
                    <input type="mobile" placeholder="01xxxxxxxxx" name="customer_contact" value="<?=$mobile;?>" id="customer_contact" required style="width: 88%;">
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label></label>
                </div>
    
                
                <div class="group">
                    <select name="area_id" id="area_id" class="append-option" required>
                        <option value="">Select an Area</option>
                        <?php
                        $areas =  getAreaUnderCity(1);
                        if($areas): ?>
                        <?php foreach($areas as $area): ?>
                        <option value="<?php echo $area->area_id; ?>" <?php if($area_id==$area->area_id){ echo "selected";} ?>><?php echo $area->area_name; ?></option>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label></label>
                </div>
                
                <div class="group">      
                    <textarea  type="text"  placeholder="Address" name="customer_address" id="customer_address" required></textarea>
                    <span class="highlight"></span>
                    <span class="bar"></span>
                    <label></label>
                </div>
            </div>
            
            <button id="submit_btn" class="ripplelink" type="submit">Next</button>

        </form>
    </div>
</section>



<script>
jQuery(function($){
    $("#cusomerInfo").validate({
        rules: {
            customer_contact:  {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 11,
                digits: true,
            },
            customer_name:  {
                required: true,
            },
            area_id:  {
                required: true,
            },
            customer_address:  {
                required: true,
            }
           
        },
        messages: {

            mobile: {
                required: "Number must be fill up",
                number: "Number must be digits",
                minlength: "Number must be at least 10 characters long",
                maxlength: "Number must enter in 11 characters",
                digits: "Number must be digits",
            },
            customer_name: {
                required: "Enter your full name",
            },
            area_id: {
                required: "Select your area",
            },
            customer_address: {
                required: "Enter your address",
            },
        }
    })
});
</script>