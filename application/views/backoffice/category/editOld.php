<?php
$category_id = $catInfo->category_id;
$category_name = $catInfo->category_name;
$category_description = $catInfo->category_description;
$category_img = $catInfo->category_img;
$category_type = $catInfo->category_type;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Catgeory Management
        <small>Add / Edit Catgeory</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Catgeory Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo site_url() ?>backoffice/updateCategory" method="post" id="addCategory" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-10">                                
                                    <div class="form-group">
                                        <label for="category_name">Name</label>
                                        <input type="text" class="form-control" id="category_name" placeholder="Full Name" name="category_name" value="<?php echo $category_name; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $category_id; ?>" name="category_id" id="category_id" />    
                                    </div>
                                    
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="category_description">Description</label>
                                        <textarea class="form-control required" id="category_description" name="category_description" rows="4"><?php echo $category_description; ?></textarea>
                                    </div>
                                </div>
                                <?php if($category_img !== ""){ ?>
                                <div class="col-md-10">
                                    <img class="img-responsive" src="<?php echo site_url(); ?>drives/category/<?php if($category_img !== ''){echo $category_img;}?>">
                                </div>
                                <?php } ?>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="category_img">Category Image</label>
                                        <input type="file" class="form-control"  id="category_img" name="category_img">
                                    </div>
                                </div>
                                
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="category_type">Category Type</label>
                                        <select class="form-control required" name="category_type">
                                            <option value="1" <?php if($category_type=="1"){echo "selected";}?>>Men</option>
                                            <option value="2" <?php if($category_type=="2"){echo "selected";}?>>Women</option>
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

<script src="<?php echo site_url(); ?>resource/backoffice/assets/js/addCategory.js" type="text/javascript"></script>