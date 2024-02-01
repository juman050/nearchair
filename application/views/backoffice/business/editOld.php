<?php
$business_id  = $businessInfo->business_id;
$business_name= $businessInfo->business_name;
$business_description = $businessInfo->business_description;
$address      = $businessInfo->address;
$map_link     = $businessInfo->business_location;
$postal_code  = $businessInfo->postal_code;
$total_chairs = $businessInfo->total_chairs;
$opening_time = $businessInfo->opening_time;
$closing_time = $businessInfo->closing_time;
$business_img = $businessInfo->business_img;
$email        = $businessInfo->email;
$mobile       = $businessInfo->mobile_number;
$business_cityId = $businessInfo->city_id;
$business_areaId = $businessInfo->area_id;
$business_type = $businessInfo->business_type;
$business_status = $businessInfo->business_status;
?>
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
                        <h3 class="box-title">Enter Business Details </h3>
                        <a href="<?php echo site_url('backoffice/offer/addNew/'.$business_id);?>" class="btn btn-success pull-right">Offer Information</a>
                    </div><!-- /.box-header -->
                     <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="editBusiness" action="<?php echo site_url() ?>backoffice/updateBusiness" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <?php if($business_img !== null){ ?>
                                <div class="col-md-4">
                                    <img class="img-responsive" src="<?php echo site_url(); ?>drives/business/<?php if($business_img !== ''){echo $business_img;}?>">
                                </div>
                                <?php } ?>
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="business_name">Business Name</label>
                                        <input type="text" class="form-control required" value="<?php echo $business_name; ?>" id="business_name" name="business_name" maxlength="128">
                                        <input type="hidden" value="<?php echo $business_id; ?>" name="business_id" id="business_id" /> 
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="business_description">Business Description</label>
                                        <textarea class="form-control required" id="business_description" name="business_description" rows="4"><?php echo $business_description; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control required digits" id="mobile" value="<?php echo $mobile; ?>" name="mobile" maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" class="form-control required email" id="email" value="<?php echo $email; ?>" name="email" maxlength="128">
                                    </div>
                                </div>
                                    
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city_id">City</label>
                                        <select class="form-control required" name="city_id" id="city_id" onChange="getArea(this.value);">
                                            <?php
                                            if(!empty($cities))
                                            {
                                                foreach ($cities as $city)
                                                {
                                                    ?>
                                                    <option value="<?php echo $city->city_id ?>" <?php if($business_cityId==$city->city_id){ echo "selected=selected"; } ?>><?php echo $city->city_name ?></option>
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
                                            <?php 
                                            $area =  getAreaUnderCity($business_cityId);
                                            if (!empty($area)){
                                                $slct ='';
                                                foreach($area as $ar){ ?>
                                                   <option value="<?=$ar->area_id;?>" <?php if($business_areaId == $ar->area_id){ echo "selected=selected"; }?> ><?=$ar->area_name;?></option>
                                                <?php 
                                                    
                                                }
                                            }
                                            else { ?>
                                                <option value disabled selected>Select Area</option> 
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                    
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control required" id="address" value="<?php echo $address; ?>" name="address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="text" class="form-control required" value="<?php echo $postal_code; ?>" id="postal_code" name="postal_code" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="opening_time">Opening Time</label>
                                        <input type="text" class="form-control required" value="<?php echo $opening_time; ?>" id="opening_time" name="opening_time" maxlength="6">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nearchair_location">Closing Time</label>
                                        <input type="text" class="form-control required" value="<?php echo $closing_time; ?>" id="closing_time" name="closing_time" maxlength="6">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="total_chairs">Total Chairs</label>
                                        <input type="text" class="form-control digits required" value="<?php echo $total_chairs; ?>" id="total_chairs" name="total_chairs" maxlength="3">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nearchair_location">Google Map Link <small>(put embed iframe link here...)</small></label>
                                        <textarea class="form-control required" id="business_location" name="business_location" rows="4" ><?php echo $map_link; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="business_img">Business Image</label>
                                        <input type="file" class="form-control" id="business_img" name="business_img">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="business_type">Business Type</label>
                                        <select class="form-control required" name="business_type" id="business_type">
                                            <option value="1"  <?php if($business_type==1){ echo "selected=selected"; } ?>>Salon</option>
                                            <option value="2" <?php if($business_type==2){ echo "selected=selected"; } ?>>Parlor</option> 
                                            <option value="3" <?php if($business_type==3){ echo "selected=selected"; } ?>>Both</option> 
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="business_status">Business Status</label>
                                        <select class="form-control required" name="business_status" id="business_status">
                                            <option value="0" <?php if($business_status==0){ echo "selected=selected"; } ?>>Pending</option>
                                            <option value="1" <?php if($business_status==1){ echo "selected=selected"; } ?>>Accepted</option> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-success" value="Update" />
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
<script src="<?php echo base_url(); ?>resource/backoffice/assets/js/editBusiness.js" type="text/javascript"></script>
<script>
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
</script>