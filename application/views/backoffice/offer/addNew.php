<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Offer Management
        <small>Add / Edit offer</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
            <?php 
                $business = getBusinessData($business_id);
                $business_type=$business->business_type;
            ?>
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?=$business->business_name;?> (Offer Details)</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addOffer" action="<?php echo site_url() ?>backoffice/offer/addNewOffer" method="post" role="form" enctype="multipart/form-data">
                        <input type="hidden" name="business_id" value="<?= $business_id;?>"/>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="offer_title">Offer Title</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('offer_title'); ?>" id="offer_title" name="offer_title" maxlength="128" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="offer_type">Offer Type</label>
                                        <select class="form-control required" name="offer_type" id="offer_type">
                                            <option value="all">all</option>
                                            <option value="included">included</option>
                                            <option value="not_included">not included</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="row" id="included_or_not" style="display:none">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="service_ids">Service <span class="in_or_not_txt"></span> </label>
                                        <select name="service_ids[]" multiple="multiple" data-selected-text-format="count" data-actions-box="true" data-live-search="true" size="5" 
                                        class="selectpicker required" title="Select Option" title="Select Option"  id="service_ids">
                                            <?php 
                                            $getCategoryItems = getAllCategoryByType($business_type);
                                            if (!empty($getCategoryItems)) {
                                               foreach ($getCategoryItems->result() as $CategoryItems) {                                              
                                            ?>
                                                <optgroup label="<?= $CategoryItems->category_name ?>">
                                                  <?php 
                                                    $services = getBusinessServiceUnderCategory($CategoryItems->category_id,$business_id);
                                                    if (!empty($services)) {
                                                        foreach ($services as $service) {   
                                                    ?>
                                                        <option value="<?= $service->service_id;?>" >
                                                        <?= $service->service_name; ?> - (Tk. <?= $service->service_price; ?>)
                                                        </option>
                                                    <?php 
                                                       }
                                                    }
                                                    ?>
                                                </optgroup>
                                                <?php 
                                                }
                                             }
                                             ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="discount">Discount percentage</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('discount'); ?>" id="discount" name="discount" maxlength="128" >
                                    </div>
                                    
                                </div>
                                
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="offer_status">Offer Status</label>
                                        <select class="form-control required" name="offer_status" id="offer_status">
                                            <option value="1">Enabled</option>
                                            <option value="0">Not enabled</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="start_time">Start Date Time</label>
                                        <input type="text" class="form-control required datepicker" value="<?php echo set_value('start_time'); ?>" id="start_time" name="start_time" maxlength="128" >
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="end_time">End Date Time</label>
                                        <input type="text" class="form-control required datepicker" value="<?php echo set_value('end_time'); ?>" id="end_time" name="end_time" maxlength="128" >
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
<script type="text/javascript">
$(document).ready(function () {
    $('select.selectpicker').selectpicker();
});

$(document).ready(function() {
    $("#offer_type").on('change', function () {  
        var offer_type = document.getElementById("offer_type").value;
        if(offer_type=='included' || offer_type=='not_included'){
            $("#included_or_not").css("display","block");   
            if(offer_type=='included'){
                $('.in_or_not_txt').text('included');
            }else{
                $('.in_or_not_txt').text('not included');
            }
        }else{
            $("#included_or_not").css("display","none");   
        }
    }); 
    var today = new Date();
    var currentday = new Date(today.getFullYear(), today.getMonth(), today.getDate());
    $input = $("#start_time");
    $input.datetimepicker({
         autoclose: true,
         format : "yyyy-mm-dd hh:ii",
         startDate: currentday,
         showMeridian: true,
         pickerPosition: 'top-left',
    });
    
    $input2 = $("#end_time");
    $input2.datetimepicker({
         autoclose: true,
         format : "yyyy-mm-dd hh:ii",
         startDate: currentday,
         showMeridian: true,
         pickerPosition: 'top-left',
    });
});
</script>
<script src="<?php echo base_url(); ?>resource/backoffice/assets/js/addOffer.js" type="text/javascript"></script>