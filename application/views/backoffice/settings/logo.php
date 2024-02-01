<?php
if(!empty($system_data)){
$nearchair_app_logo = $system_data->nearchair_app_logo;
$nearchair_web_logo = $system_data->nearchair_web_logo;
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Logo Management
        <small>Add / Edit Logo</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-4">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Customize Web Logo</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo site_url() ?>backoffice/updateLogo" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <?php if($nearchair_web_logo !== NULL){ ?>
                                <div class="col-md-10">
                                    <img class="img-responsive" src="<?php echo site_url(); ?>drives/logo/web/<?php if($nearchair_web_logo !== ''){echo $nearchair_web_logo;}?>">
                                </div>
                                <?php } ?>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="nearchair_web_logo">Web Logo</label>
                                        <input type="file" class="form-control"  id="nearchair_web_logo" name="nearchair_web_logo" required="required">
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
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Customize App Logo</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo site_url() ?>backoffice/updateAppLogo" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <?php if($nearchair_app_logo !== NULL){ ?>
                                <div class="col-md-10">
                                    <img class="img-responsive" src="<?php echo site_url(); ?>drives/logo/app/<?php if($nearchair_app_logo !== ''){echo $nearchair_app_logo;}?>">
                                </div>
                                <?php } ?>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="nearchair_app_logo">App Logo</label>
                                        <input type="file" class="form-control"  id="nearchair_app_logo" name="nearchair_app_logo" required="required">
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