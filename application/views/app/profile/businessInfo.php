<link rel="stylesheet" href="<?php echo base_url(); ?>resource/user/css/user.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">
<style>
.error{font-size:15px;}
</style>
<?php if($global_business_id): ?>
<script>
    var global_business_id = '<?php echo $global_business_id; ?>';
</script>
<?php else: ?>
<script>
    var global_busines_id = '';
</script>
<?php endif; ?>

    <?php if($allbusinesses[0]->business_img){ ?>
        <section class="ownerProfileCoverSection" style="background-image:url('<?php echo base_url(); ?>drives/business/<?php echo $allbusinesses[0]->business_img; ?>')">
    </section>
    <?php }else{ ?>
        <section class="ownerProfileCoverSection" style="background-image:url('<?php echo base_url(); ?>drives/users/no-image.png')">
    </section>
    <?php } ?>

<section class="home-page-gategory-section" style="min-height:100vh;background:url('<?php echo base_url() ?>resource/app/icon/bg.png');">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">

                <?php if(!empty($allbusinesses)): ?>
                    <form enctype="multipart/form-data" id="businessForm" style="margin-bottom: 80px;margin-top: -40px;">


                        <input type="hidden" name="business_id" id="business_id" class="form-control" value="<?php echo $allbusinesses[0]->business_id;  ?>">

                        <div class="emon_dsgn_upload">
                          <div class="file-upload">
                            <input type="file" name="business_img" id="business_img" />Upload Cover Photo
                          </div>
                        </div>
                        
                        
                    <div style="background: #FFFFFF;padding: 30px 10px 10px 10px;;border-radius: 10px;margin-bottom: 35px;">
                        
                        <div class="group">      
                            <input  type="text"  placeholder="Business Name" name="business_name" id="business_name"  value="<?php echo $allbusinesses[0]->business_name;  ?>" required  >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>

                        
                        <div class="group">
                            <select name="city_id" id="city_id" required>
                                <?php foreach ($allCities as $cities) { ?>
                                <option <?php if($cities->city_id == $allbusinesses[0]->city_id){echo 'selected';} ?> value="<?php echo $cities->city_id; ?>"><?php echo $cities->city_name; ?></option>
                                <?php } ?>
                            </select>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
                        

                        <div class="group">      
                            <input  type="text"  placeholder="Address" name="address" id="address"  value="<?php echo $allbusinesses[0]->address;  ?>" required  >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
                        
                        <div class="group">      
                            <input  type="number"  placeholder="Mobile Number" name="mobile" id="mobile"  value="<?php echo $allbusinesses[0]->mobile_number;  ?>" required  >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
                        
                        <div class="group">      
                            <input  type="number"  placeholder="Total Chairs" name="total_chairs" id="total_chairs"  value="<?php echo $allbusinesses[0]->total_chairs;  ?>" required  >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
                        

                        <div class="group">      
                            <input  type="number"  placeholder="Post Code" name="postal_code" id="postal_code"  value="<?php echo $allbusinesses[0]->postal_code;  ?>" required  >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
                        
                        
                        <div class="group">
                            <textarea rows="5" id="business_description" name="business_description" placeholder="Description..." ><?php echo $allbusinesses[0]->business_description;  ?></textarea>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>

                        <!--<div class="group col-sm-12 col-xs-12">      -->
                        <!--    <input  type="email"  placeholder="Email" value="<?php echo $allbusinesses[0]->email;  ?>" required  disabled="true"  >-->
                        <!--    <span class="highlight"></span>-->
                        <!--    <span class="bar"></span>-->
                        <!--    <label></label>-->
                        <!--</div>-->
                        
                        <!--<div class="group col-sm-12 col-xs-12">      -->
                        <!--    <input  type="text"  placeholder="Joining Date"  value="<?php echo date( 'M d, Y h:i a',strtotime($allbusinesses[0]->createdDtm));  ?>" disabled="true" >-->
                        <!--    <span class="highlight"></span>-->
                        <!--    <span class="bar"></span>-->
                        <!--    <label></label>-->
                        <!--</div>-->
                        </div>
                        <button id="submit_btn" type="submit" class="addBusiness">Submit</button>

                    </form>
                <?php else: ?>
                    <p class="text-center">Your business is pending now</p>
                <?php endif; ?>

            </div>
            
        </div>
    </div>
</section>


<script type="text/javascript" src="<?php echo base_url(); ?>/resource/owner/js/pages/profile.js"></script>
<script>
jQuery(function($){
    
    
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.ownerProfileCoverSection').css('background-image', 'url('+e.target.result +')');
                $('.ownerProfileCoverSection').hide();
                $('.ownerProfileCoverSection').fadeIn(650);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#business_img").change(function(){
        readURL2(this);
    });
    
    
    
    if ($("#businessForm").length > 0) {
        $("#businessForm").validate({
          
        rules: {
            business_name: 'required',
            city_id:  {
                required: true,
                },
            address: {
                 required: true,        
                },
            email: {
                 required: true,
                 email: true,
                },
            mobile: {
                 required: true,
                 number: true,
                 minlength: 11,
                 maxlength: 11,
                },
            total_chairs: {
                 required: true,
                 number: true,
                },
            postal_code: {
                 required: true,
                 number: true,
                },
           
        },
        messages: {
            business_name: "Name Must be field!",   
            city_id:{
                required: "Select a catrgory",
            },    
            address: {
                required:"Enter Address",
            },    
            email: {
                required:"Enter Email Address",
                email: 'Type valid email',
            },
            mobile: {
                required: "Enter Mobile Number",
                number: "Please enter only number",
                minlength: "Enter minimum 11 digits",
                maxlength: "Enter Maximum 11 digits",
            },
            total_chairs: {
                required: "Enter Total Chairs",
                number: "Please enter only number",
            },
            postal_code: {
                required: "Enter Post Code",
                number: "Please enter only number",
            }
          
        },
        submitHandler: function(form) {
            var formData = new FormData($('#businessForm')[0]);
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: baseURL+'app/updateBusiness',
                data: formData,
                contentType: false,
                processData: false,
                // beforeSend: function() { $.LoadingOverlay("show"); },
                // complete: function() { $.LoadingOverlay("hide"); },
                success: function(response){
                    $('#success_tic').modal('show');
                    $('#success_tic').find('.head-text').html(response);
                }
            });
        }
      })
    }


});
</script>
