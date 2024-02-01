<?php
$area_id = $catInfo->area_id;
$area_name = $catInfo->area_name;
$city_id = $catInfo->city_id;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Area Management
        <small>Add / Edit Area</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Area Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo site_url() ?>backoffice/updateArea" method="post" id="addArea" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-10">    
                                
                                    <div class="form-group">
                                        <label for="city_id">City Name</label>
                                        <select class="form-control required"  id="city_id" name="city_id">
                                            <?php if($cities): ?>
                                            <?php foreach($cities as $city): ?>
                                            <option <?php if($city->city_id == $city_id){ ?> selected="selected" <?php } ?> value="<?php echo $city->city_id; ?>"><?php echo $city->city_name; ?></option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="area_name">Name</label>
                                        <input type="text" class="form-control" id="area_name" placeholder="Full Name" name="area_name" value="<?php echo $area_name; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $area_id; ?>" name="area_id" id="area_id" />    
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

<script src="<?php echo site_url(); ?>resource/backoffice/assets/js/addArea.js" type="text/javascript"></script>