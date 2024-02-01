<?php


    $service_id = "";
    $service_name = "";
    $service_price = "";
    $service_type = "";
    $service_discount_price = "";
    $service_description = "";
    $cat_id = "";
    $service_time = "";
    $hr = "";
    $min = "";
        
    if($page_sts=="EDIT"){
        $service_id = $singleService[0]->serviceId;
        $service_name = $singleService[0]->serviceName;
        $service_price = $singleService[0]->servicePrice;
        $service_type = $singleService[0]->service_type;
        $service_discount_price = $singleService[0]->serviceDiscountPrice;
        $service_description = $singleService[0]->serviceDescription;
        $cat_id = $singleService[0]->catId;
        $service_time = $singleService[0]->serviceTime;
        $time = explode(":",$service_time);
        $hr = $time[0];
        $min = $time[1];
    }


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i>Home Service Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    
    <section class="content">
        

        <div class="row">
            <!-- left column -->
            <div class="col-md-5">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $page_sts; ?> Service</h3>
                    </div><!-- /.box-header -->
                     <!-- form start -->
                    <?php $this->load->helper("form"); ?>

                    <?php if($page_sts=="EDIT"){ ?>
                    <form role="form" id="storeBusinessService" action="<?php echo site_url() ?>backoffice/homeService/updateBusinessService" method="post" role="form">
                        <input type="hidden" name="service_id" id="service_id" class="form-control" value="<?php echo $service_id;  ?>" required="required">
                    <?php } ?>
                    <?php if($page_sts=="ADD"){ ?>
                    <form role="form" id="storeBusinessService" action="<?php echo site_url() ?>backoffice/homeService/storeBusinessService" method="post" role="form">
                    <?php } ?>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="service_name">Service Name</label>
                                        <input type="text" class="form-control required" value="<?php echo $service_name; ?>" id="service_name" name="service_name" maxlength="128">
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cat_id">Category</label>
                                        <select class="form-control" id="cat_id" name="cat_id" required="required">
                                            <option value="">Select Category</option>
                                            <?php 
                                    
                                                if($allcategories){
                                                    foreach ($allcategories as $category) { ?>
                                    
                                                        <option value="<?=$category->category_id?>" <?php if($cat_id==$category->category_id){ ?> selected="selected" <?php } ?>>
                                                            <?=$category->category_name?> <?php if($category->category_type=='1'){ echo ' <b>(Gents)</b>'; }else{ echo ' <b>(Ladies)</b>'; } ?>
                                                        </option>
                                                
                                            <?php
                                                    }
                                                }
                                    
                                            ?>
                                        </select>
                                    </div>
                                </div>   
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="service_description">Service Description</label>
                                        <textarea class="form-control" id="service_description" name="service_description" rows="4"><?php echo $service_description; ?></textarea>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="service_price">Service Price</label>
                                        <input type="text" class="form-control required digits" id="service_price"  value="<?php echo $service_price; ?>" name="service_price"  maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="service_price">Service Discount Price</label>
                                        <input type="text" class="form-control digits" id="service_discount_price"  value="<?php echo $service_discount_price; ?>" name="service_discount_price"  maxlength="11">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <!--<div class="col-md-4">-->
                                <!--    <div class="form-group">-->
                                <!--        <label for="service_type">Service For</label>-->
                                <!--        <select class="form-control" id="service_type" name="service_type" required="required">-->
                                <!--            <option value="1" <?php if($service_type=='1'){ ?> selected="selected" <?php } ?>>Men</option>-->
                                <!--            <option value="2" <?php if($service_type=='2'){ ?> selected="selected" <?php } ?>>Women</option>-->
                                <!--        </select>-->
                                <!--    </div>-->
                                <!--</div>                            -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        
                                        <label for="service_time_hr">Service Hour</label>
                                        
                                        <select class="form-control" id="service_time_hr" name="service_time_hr" required="required">
                                            <option value="00">00</option>
                                            <?php for($i=1;$i<24;$i++){ 
                                    
                                                    if($i<10){
                                                      $count = 0;
                                                    }else{
                                                      $count="";
                                                    }
                                    
                                                ?>
                                                <option value="<?php echo $count.$i; ?>" <?php if($hr==$count.$i){ ?> selected="selected" <?php } ?> ><?php echo $count.$i; ?></option>
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="service_time_min">Service Min</label>
                                        <select class="form-control" id="service_time_min" name="service_time_min" required="required">
                                            <option value="00">00</option>
                                            <?php for($j=5;$j<60;$j+=5){ 
                                    
                                                    if($j<10){
                                                      $count2 = 0;
                                                    }else{
                                                      $count2="";
                                                    }
                                    
                                                ?>
                                                <option value="<?php echo $count2.$j; ?>" <?php if($min==$count2.$j){ ?> selected="selected" <?php } ?>><?php echo $count2.$j; ?></option>
                                            <?php } ?>
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
            <div class="col-md-7">
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

                <div class="row">
                    <div class="col-md-12">
                      <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Service List</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                          <table class="table table-hover">
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <!--<th>Service For</th>-->
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                            if(!empty($seviceList))
                            {
                                foreach($seviceList as $sevice)
                                {
                            ?>
                            <tr>
                                <td><?php echo $sevice->serviceName; ?></td>
                                <td><?php echo $sevice->category_name; ?> <?php if($sevice->category_type=='1'){ echo ' <b>(Gents)</b>'; }else{ echo ' <b>(Ladies)</b>'; } ?></td>
                                <td>
                                    
                                    <?php
                                    if(($sevice->serviceDiscountPrice!=0.00) || ($sevice->serviceDiscountPrice!=0)){
                                        echo $sevice->serviceDiscountPrice.' <del>'.$sevice->servicePrice.'</del>';
                                    }else{
                                        echo $sevice->servicePrice;
                                    }
                                    ?>
                                </td>
                                <td><?php if($sevice->service_type=='1'){ echo 'Men'; }else{ echo 'Women';  } ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url().'backoffice/homeService/editService/'.$sevice->serviceId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-sm btn-danger deleteService" href="#" data-service_id="<?php echo $sevice->serviceId; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                          </table>
                          
                        </div><!-- /.box-body -->

                      </div><!-- /.box -->

                    </div>
                </div>
            </div>
        </div>    
        
    </section>
    
</div>
<script src="<?php echo base_url(); ?>resource/backoffice/assets/js/addHomeService.js" type="text/javascript"></script>
<script>
        //This function is used to delete the category from the system
	jQuery(document).on("click", ".deleteService", function(){
		var service_id = $(this).data("service_id");
		hitURL = baseURL + "backoffice/homeService/deleteService",
		currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Service ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { service_id : service_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Service successfully deleted"); }
				else if(data.status = false) { alert("Service deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});

</script>
