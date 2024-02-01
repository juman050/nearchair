<?php 
if(!empty($system_data)){
    $title       = $system_data->nearchair_name;
    $description = $system_data->nearchair_description;
    $address     = $system_data->nearchair_address;
    $mobile      = $system_data->nearchair_mobile;
    $email       = $system_data->nearchair_email;
    $msg_email   = $system_data->nearchair_send_email;
    $loc         = $system_data->nearchair_location;
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> System Management
        <small>Add / Edit System</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-4">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter System Info</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" action="<?php echo site_url() ?>backoffice/updateSystemInfo" method="post" role="form" >
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="nearchair_name">Nearchair Title</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($title) ? $title : set_value('nearchair_name'); ?>" id="nearchair_name" name="nearchair_name" maxlength="128" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nearchair_description">Nearchair Description</label>
                                        <textarea class="form-control required" id="nearchair_description" name="nearchair_description" rows="4"><?php echo isset($description) ? $description : set_value('nearchair_description'); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="nearchair_mobile">Nearchair Contact Number</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($mobile) ? $mobile : set_value('nearchair_mobile'); ?>" id="nearchair_mobile" name="nearchair_mobile" maxlength="128" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nearchair_address">Nearchair Address</label>
                                        <textarea class="form-control required" id="nearchair_address" name="nearchair_address" rows="4"><?php echo isset($address) ? $address : set_value('nearchair_address'); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nearchair_location">Location Link <small>(put embed iframe link here...)</small></label>
                                        <textarea class="form-control required" id="nearchair_location" name="nearchair_location" rows="4" ><?php echo isset($loc) ? $loc : set_value('nearchair_location'); ?></textarea>
                                    </div>
                                </div>
                                <?php if(isset($loc)){?>
                                <div class="col-md-12">
                                    <iframe src="<?=$loc;?>" style="max-width:375px;width:100%;border:0" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                                    
                                </div>
                                <?php } ?>
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-success" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <!-- left column -->
            <div class="col-md-4">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">System mail</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" action="<?php echo site_url() ?>backoffice/updateSystemInfo" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="nearchair_email">System business email</label>
                                        <input type="email" class="form-control required" value="<?php echo isset($email) ? $email : set_value('nearchair_email'); ?>" id="nearchair_email" name="nearchair_email" maxlength="128" >
                                    </div>
                                </div>
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="nearchair_send_email">System message email</label>
                                        <input type="email" class="form-control required" value="<?php echo isset($msg_email) ? $msg_email : set_value('nearchair_send_email'); ?>" id="nearchair_send_email" name="nearchair_send_email" maxlength="128" >
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