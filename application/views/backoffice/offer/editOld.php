<?php 
$offer_id    = $offerInfo->offer_id;
$offer_title = $offerInfo->offer_title;
$business_id = $offerInfo->business_id;
$offer_type = $offerInfo->offer_type;
$service_ids="";
if($offer_type!=='all'){
    $service_ids=$offerInfo->service_ids;
}
$start_time = $offerInfo->start_time;
$end_time = $offerInfo->end_time;
$offer_status = $offerInfo->offer_status;
$discount = $offerInfo->discount;

$business = getBusinessData($business_id);
$business_type=$business->business_type;
?>

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
                

                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?=$business->business_name;?> (Offer Details)</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addOffer" action="<?php echo site_url('backoffice/updateOffer') ?>" method="post" role="form" enctype="multipart/form-data">
                        <input type="hidden" name="business_id" value="<?= $business_id;?>"/>
                        <input type="hidden" name="offer_id" value="<?= $offer_id;?>"/>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="offer_title">Offer Title</label>
                                        <input type="text" class="form-control required" value="<?php echo $offer_title; ?>" id="offer_title" name="offer_title" maxlength="128" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="offer_type">Offer Type</label>
                                        <select class="form-control required" name="offer_type" id="offer_type">
                                            <option value="all" <?php if($offer_type=='all'){ echo "selected"; }?>>all</option>
                                            <option value="included" <?php if($offer_type=='included'){ echo "selected"; }?>>included</option>
                                            <option value="not_included" <?php if($offer_type=='not_included'){ echo "selected"; }?>>not included</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="row" id="included_or_not" style="display:<?php if($service_ids==""){ echo 'none'; } ?>">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="service_ids">Service <span class="in_or_not_txt"></span> </label>
                                        <select name="service_ids[]" multiple="multiple" data-selected-text-format="count" data-actions-box="true" data-live-search="true" size="5" 
                                        class="selectpicker required" title="Select Option" title="Select Option"  id="service_ids">
                                            <?php 
                                            $getCategoryItems = getAllCategoryByType($business_type);
                                            if (!empty($getCategoryItems)) {
                                                if($service_ids!==""){ 
                                                    $sids=1;
                                                }else{
                                                   $sids=0; 
                                                }
                                               foreach ($getCategoryItems->result() as $CategoryItems) {                                              
                                            ?>
                                                <optgroup label="<?= $CategoryItems->category_name ?>">
                                                  <?php 
                                                    $services = getBusinessServiceUnderCategory($CategoryItems->category_id,$business_id);
                                                    if (!empty($services)) {
                                                        foreach ($services as $service) { 
                                                        $str="";
                                                        if($sids=="1"){
                                                           $ids=explode(",",$service_ids); 
                                                           
                                                           $a = 0;
                                                           while( $a <= count($ids)) { 
                                                               if($ids[$a]==$service->service_id){
                                                                   $str="selected"; 
                                                               }
                                                               $a++;
                                                           }
                                                           
                                                        }
                                                    ?>
                                                        <option value="<?= $service->service_id;?>" <?=$str;?> >
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
                                        <input type="number" class="form-control required" value="<?php echo $discount; ?>" id="discount" name="discount" maxlength="128" >
                                    </div>
                                    
                                </div>
                                
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="offer_status">Offer Status</label>
                                        <select class="form-control required" name="offer_status" id="offer_status">
                                            <option value="1" <?php if($offer_type=='1'){ echo "selected"; }?>>Enabled</option>
                                            <option value="0" <?php if($offer_type=='0'){ echo "selected"; }?>>Not enabled</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="start_time">Start Date Time</label>
                                        <input type="text" class="form-control required datepicker" value="<?php echo $start_time; ?>" id="start_time" name="start_time" maxlength="128" >
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="end_time">End Date Time</label>
                                        <input type="text" class="form-control required datepicker" value="<?php echo $end_time; ?>" id="end_time" name="end_time" maxlength="128" >
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