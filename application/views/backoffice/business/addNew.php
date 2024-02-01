<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Business Management
        <small>Add / Edit Business</small>
      </h1>
    </section>
    
    <section class="content">
        

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Business Details</h3>
                    </div><!-- /.box-header -->
                     <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addBusiness" action="<?php echo site_url() ?>backoffice/business/addNewBusiness" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="business_name">Business Name</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('business_name'); ?>" id="business_name" name="business_name" maxlength="128" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)">
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="business_name">Business Slug</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('business_slug'); ?>" id="business_slug" name="business_slug" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="business_description">Business Description</label>
                                        <textarea class="form-control required" id="business_description" name="business_description" rows="4"><?php echo set_value('business_description'); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control required digits" id="mobile" value="<?php echo set_value('mobile'); ?>" name="mobile"  maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" class="form-control required email" id="email" value="<?php echo set_value('email'); ?>" name="email" maxlength="128">
                                    </div>
                                </div>
                                    
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city_id">City</label>
                                        <select class="form-control required" name="city_id" id="city_id" onChange="getArea(this.value);">
                                            <option value="">Select City</option>
                                            <?php
                                            if(!empty($cities))
                                            {
                                                foreach ($cities as $city)
                                                {
                                                    ?>
                                                    <option value="<?php echo $city->city_id ?>"><?php echo $city->city_name ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="area_id">Area</label>
                                        <select class="form-control required" name="area_id" id="area_id" >
                                            <option value="">Select Area</option>
                                        </select>
                                    </div>
                                </div>
                                    
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control required" id="address" value="<?php echo set_value('address'); ?>" name="address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('postal_code'); ?>" id="postal_code" name="postal_code" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="opening_time">Opening Time</label>
                                        <input type="text" class="form-control required" placeholder="10:00" value="10:00" id="opening_time" name="opening_time" maxlength="6">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nearchair_location">Closing Time</label>
                                        <input type="text" class="form-control required"  placeholder="23:00" value="23:00" id="closing_time" name="closing_time" maxlength="6">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="total_chairs">Total Chairs</label>
                                        <input type="text" class="form-control digits required" value="<?php echo set_value('total_chairs'); ?>" id="total_chairs" name="total_chairs" maxlength="3">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nearchair_location">Google Map Link <small>(put embed iframe link here...)</small></label>
                                        <textarea class="form-control required" id="business_location" name="business_location" rows="4" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="business_img">Business Image</label>
                                        <input type="file" class="form-control required" value="<?php echo set_value('business_img'); ?>" id="business_img" name="business_img">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="business_type">Business Type</label>
                                        <select class="form-control required" name="business_type" id="business_type">
                                            <option value="">Select One</option>
                                            <option value="1">Salon</option>
                                            <option value="2">Parlor</option> 
                                            <option value="3">Both</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="business_status">Business Status</label>
                                        <select class="form-control required" name="business_status" id="business_status">
                                            <option value="0">Pending</option>
                                            <option value="1">Accept</option> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-success" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
                
            </div>
        </div>    
        
    </section>
    
</div>
<script src="<?php echo base_url(); ?>resource/backoffice/assets/js/addBusiness.js" type="text/javascript"></script>
<script type="text/javascript">
function getArea(val) {
	$.ajax({
	type: "POST",
	url: '<?php echo site_url("backoffice/area/getAreaUnderCity");?>',
	data:'city_id='+val,
	success: function(data){
		$("#area_id").html(data);
	}
	});
}


/* Encode string to slug */
function convertToSlug( str ) {
	
  //replace all special characters | symbols with a space
  str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
	
  // trim spaces at start and end of string
  str = str.replace(/^\s+|\s+$/gm,'');
	
  // replace space with dash/hyphen
  str = str.replace(/\s+/g, '-');	
  document.getElementById("business_slug").value= str;
  //return str;
}


</script>