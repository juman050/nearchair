<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Category Management
        <small>Add / Edit Category</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Category Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addCategory" action="<?php echo site_url() ?>backoffice/category/addNewCategory" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-10">                                
                                    <div class="form-group">
                                        <label for="category_name">Category Name</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('category_name'); ?>" id="category_name" name="category_name" maxlength="128" onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)">
                                    </div>
                                    
                                </div>
                                <div class="col-md-10">                                
                                    <div class="form-group">
                                        <label for="category_slug">Category Slug</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('category_slug'); ?>" id="category_slug" name="category_slug" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="category_description">Category Description</label>
                                        <textarea class="form-control required" id="category_description" name="category_description" rows="4"><?php echo set_value('category_description'); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="category_img">Category Image</label>
                                        <input type="file" class="form-control required" value="<?php echo set_value('category_img'); ?>" id="category_img" name="category_img">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="category_type">Category Type</label>
                                        <select class="form-control required" name="category_type">
                                            <option value="">Select One</option>
                                            <option value="1">Men</option>
                                            <option value="2">Women</option>
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
<script src="<?php echo base_url(); ?>resource/backoffice/assets/js/addCategory.js" type="text/javascript"></script>
<script type="text/javascript">
/* Encode string to slug */
function convertToSlug( str ) {
	
  //replace all special characters | symbols with a space
  str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();
	
  // trim spaces at start and end of string
  str = str.replace(/^\s+|\s+$/gm,'');
	
  // replace space with dash/hyphen
  str = str.replace(/\s+/g, '-');	
  document.getElementById("category_slug").value= str;
  //return str;
}
$(document).ready(function() {
});
</script>