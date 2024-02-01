<style>
.gallery-img-wrap {
    position: relative;
    display: inline-block;
    font-size: 0;
    margin: 10px 6px;
    border: 5px solid #eeeeee;
}
.gallery-img-wrap .delete_gallery_image {
    position: absolute;
    top: -3px;
    right: -3px;
    background-color: #ff546f;
    padding: 5px;
    color: #ffffff;
    cursor: pointer;
    opacity: .2;
    text-align: center;
    font-size: 18px;
    line-height: 11px;
    opacity: 1;
    border-radius: 50%;
}
 .emon_dsgn_upload {
	 width: 100%;
	 height: 100%;
	 display: flex;
	 align-items: center;
	 justify-content: center;
	 margin-bottom: 20px;
}
 .emon_dsgn_upload .file-upload {
    border-radius: 100px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 4px solid #fff;
    overflow: hidden;
    background: #ff546f;
    background-size: 100% 200%;
    transition: all 1s;
    color: #fff;
    font-size: 22px;
    padding: 5px 30px;
}
 .emon_dsgn_upload .file-upload input[type='file'] {
     font-size: 22px;
     padding: 5px 30px;
	 position: absolute;
	 top: 0;
	 left: 0;
	 opacity: 0;
	 cursor: pointer;
}

.btn-cus {
    color: white;
    background: #ff546f;
    border-radius: 0px;
    border: none;
    border-radius: 25px;
    font-size: 16px;
    height: 38px;
    line-height: 38px;
}
</style>

<?php


    $service_id = "";
    $service_name = "";
    $service_price = "";
    $service_description = "";
    $cat_id = "";
    $service_time = "";
    $hr = "";
    $min = "";
        
    if($page_sts=="EDIT"){
        $service_id = $singleService[0]->service_id;
        $service_name = $singleService[0]->service_name;
        $service_price = $singleService[0]->service_price;
        $service_description = $singleService[0]->service_description;
        $cat_id = $singleService[0]->cat_id;
        $service_time = $singleService[0]->service_time;
        $time = explode(":",$service_time);
        $hr = $time[0];
        $min = $time[1];
    }


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-briefcase"></i>Manage services and images for <?php echo $businessName; ?>
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">

                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Gallery Images</h3>
                    </div><!-- /.box-header -->
                <?php if(!empty($businessInfo)): ?>
                <div class="form-group" id="appendImages">
                    <?php if($businessInfo[0]->gallery_image): ?>
                        <div class="col-sm-12" style="padding:0px;">
                            <?php foreach($businessInfo[0]->gallery_image as $gallery): ?>
                            <div class="gallery-img-wrap">
                                <span class="delete_gallery_image image-<?php echo $gallery->gallery_id; ?>" data-gallery_id="<?php echo $gallery->gallery_id; ?>">&times;</span>

                                <img class="image-<?php echo $gallery->gallery_id; ?>" src="<?php echo site_url().'resource/app/images/gallery/'.$gallery->image; ?>" id="gallery_image-id" style="width: 100px;height: 70px;" />
                            </div>
                            
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="col-sm-12">
                            <p>No Gallery Images</p>
                        </div>
                    <?php endif; ?>
                </div>

                <form action="<?php echo site_url() ?>backoffice/add_gallery_image" method="POST" enctype="multipart/form-data" class="form-inline" id="galleryForm" >
                    
                    <div class="form-group">
                        <div class="col-sm-12">
                            <div class="emon_dsgn_upload">
                              <div class="file-upload">
                                <input type="file" name="gallery_image[]" multiple="multiple" id="gallery_image" required="required"/>Upload Image
                              </div>
                            </div>
                            <input type="hidden" class="form-control" name="business_id" id="business_id" required="required" value="<?php echo $business_id;  ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
                            <button type="submit" name="ADD" class="btn btn-md btn-cus form-control" style="line-height: 0;">ADD</button>
                            <br><br>
                        </div>
                    </div>

                </form>
                <?php else: ?>
                    <p class="text-center">This business is pending now</p>
                <?php endif; ?>
                </div>
            </div>
        </div>   

        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $page_sts; ?> Service </h3>
                        <?php if($page_sts=="EDIT"){ ?><a href="<?= site_url('backoffice/business/addService/'.$business_id); ?>" class="btn btn-success pull-right">Add New Service</a><?php } ?>
                    </div><!-- /.box-header -->
                     <!-- form start -->
                    <?php $this->load->helper("form"); ?>

                    <?php if($page_sts=="EDIT"){ ?>
                    <form role="form" id="storeBusinessService" action="<?php echo site_url() ?>backoffice/business/updateBusinessService" method="post" role="form">
                        <input type="hidden" name="service_id" id="service_id" class="form-control" value="<?php echo $service_id;  ?>" required="required">
                    <?php } ?>
                    <?php if($page_sts=="ADD"){ ?>
                    <form role="form" id="storeBusinessService" action="<?php echo site_url() ?>backoffice/business/storeBusinessService" method="post" role="form">
                    <?php } ?>

                        <input type="hidden" name="business_id" id="business_id" class="form-control" value="<?php echo $business_id;  ?>" required="required">

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="service_name">Service Name</label>
                                        <input type="text" class="form-control required" value="<?php echo $service_name; ?>" id="service_name" name="service_name" maxlength="128">
                                    </div>
                                    
                                </div>


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
                                        <label for="cat_id">Category</label>
                                        <select class="form-control" id="cat_id" name="cat_id" required="required">
                                            <option value="">Select Category</option>
                                            <?php 
                                    
                                                if($allcategories){
                                                    foreach ($allcategories as $category) { ?>
                                    
                                                        <option value="<?=$category->category_id?>" <?php if($cat_id==$category->category_id){ ?> selected="selected" <?php } ?>><?=$category->category_name?></option>
                                                
                                            <?php
                                                    }
                                                }
                                    
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                    
                            </div>
                            <div class="row">
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
            <div class="col-md-6">
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
                                <th>Time</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                            if(!empty($seviceList))
                            {
                                foreach($seviceList as $sevice)
                                {
                            ?>
                            <tr>
                                <td><?php echo $sevice->service_name; ?></td>
                                <td><?php echo $sevice->category_name; ?></td>
                                <td><?php echo $sevice->service_price; ?></td>
                                <td><?php echo $sevice->service_time; ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-info" href="<?php echo base_url().'backoffice/business/editService/'.$sevice->service_id.'/'.$business_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-sm btn-danger deleteService" href="#" data-service_id="<?php echo $sevice->service_id; ?>" data-business_id="<?php echo $business_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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


<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <form id="deleteForm">
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Are you sure?</p>
            <input type="hidden" name="gallery_id" class="gallery_id">     
      </div>

      <!--Body-->
      <div class="modal-body">

        <h4 class="text-center">Want to Delete</h4>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a href="javascript:void(0)" class="btn  btn-success do_delete">Yes</a>
        <a type="button" class="btn  btn-danger flat-icon waves-effect" data-dismiss="modal">No</a>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>






</div>
<script src="<?php echo base_url(); ?>resource/backoffice/assets/js/addService.js" type="text/javascript"></script>
<script>
        //This function is used to delete the category from the system
	jQuery(document).on("click", ".deleteService", function(){
		var service_id = $(this).data("service_id");
		var business_id = $(this).data("business_id"),
			hitURL = baseURL + "backoffice/deleteService",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this Service ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { service_id : service_id,business_id : business_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Service successfully deleted"); }
				else if(data.status = false) { alert("Service deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
    jQuery(function($){
        
            $("#service_name").autocomplete({
                source: baseURL+'backoffice/suggestionService'
            });
    
            $(".delete_gallery_image").on("click",function(){
                $('#modalConfirmDelete').modal('show');
                $('#modalConfirmDelete').find('#deleteForm').find('.gallery_id').val($(this).data('gallery_id'));
            });
            
    
            $("#deleteForm").on("click",".do_delete",function(){
                var gallery_id = $('.gallery_id').val();
                if(gallery_id)
                {
                    $.ajax({
                        url: baseURL+'backoffice/deleteGalleryImage',
                        dataType: 'html',
                        method: 'POST',
                        data: {'gallery_id':gallery_id},
                        success: function(data){
                             $('#modalConfirmDelete').modal('hide');
                             $('#success_tic').modal('show');
                             $('#success_tic').find('.head-text').html(data);
                             $('.image-'+gallery_id).hide();
                        }
    
                    });
                }
            });
            
    
    });
</script>
