<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/bootstrap-datetimepicker.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Coupon Management
        <small>Add / Edit Coupon</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Coupon Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addCoupon" action="<?php echo site_url() ?>backoffice/coupon/addNewCoupon" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="coupon_title">Coupon Title</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('coupon_title'); ?>" id="coupon_title" name="coupon_title" maxlength="128" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="coupon_title">Coupon Code</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('coupon_code'); ?>" id="coupon_code" name="coupon_code" maxlength="128" >
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="coupon_description">Coupon Description</label>
                                        <textarea class="form-control required" id="coupon_description" name="coupon_description" rows="4"><?php echo set_value('coupon_description'); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="coupon_title">Discount Type</label>
                                        <select class="form-control required" name="discount_type" id="discount_type">
                                            <option value="">Select One</option>
                                            <option value="1">Percentage</option>
                                            <option value="2">Flat</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="discount_value">Discount <span id="changeTextAmount">Amount</span></label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('discount_value'); ?>" id="discount_value" name="discount_value" maxlength="128" >
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="minimum_total">Order minimum</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('minimum_total'); ?>" id="minimum_total" name="minimum_total" maxlength="128" >
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="user_usage">Per user usage</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('user_usage'); ?>" id="user_usage" name="user_usage" maxlength="128" >
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="start_date_time">Start Date Time</label>
                                        <input type="text" class="form-control required datepicker" value="<?php echo set_value('start_date_time'); ?>" id="start_date_time" name="start_date_time" maxlength="128" >
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="end_date_time">End Date Time</label>
                                        <input type="text" class="form-control required datepicker" value="<?php echo set_value('end_date_time'); ?>" id="end_date_time" name="end_date_time" maxlength="128" >
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
<script src="<?php echo base_url(); ?>resource/app/js/bootstrap-datetimepicker.min.js"></script> 
<script src="<?php echo base_url(); ?>resource/backoffice/assets/js/addCoupon.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#discount_type").on('change', function () {  
        var discount_type = document.getElementById("discount_type").value;
        if(discount_type=='1'){
            $("#changeTextAmount").text("percentage");   
        }else if(discount_type=='2'){
            $("#changeTextAmount").text("amount");  
        }else{
            $("#changeTextAmount").text("");  
        }
    }); 
    var today = new Date();
    var currentday = new Date(today.getFullYear(), today.getMonth(), today.getDate());
    $input = $("#start_date_time");
    $input.datetimepicker({
         autoclose: true,
         format : "yyyy-mm-dd hh:ii",
         startDate: currentday,
         showMeridian: true,
         pickerPosition: 'top-left',
    });
    
    $input2 = $("#end_date_time");
    $input2.datetimepicker({
         autoclose: true,
         format : "yyyy-mm-dd hh:ii",
         startDate: currentday,
         showMeridian: true,
         pickerPosition: 'top-left',
    });
});
</script>