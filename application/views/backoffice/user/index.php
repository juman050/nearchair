<link rel="stylesheet" href="<?php echo base_url(); ?>resource/backoffice/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" />
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> User Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-6">
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
            </div>
        </div>
        <div class="row">
          <form action="<?php echo base_url() ?>users" method="POST" id="searchList">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group">
              <div class="input-group">
                <input id="fromDate" type="text" name="fromDate" value="<?php echo $fromDate; ?>" class="form-control datepicker" placeholder="From Date" autocomplete="off" />
                <span class="input-group-addon"><label for="fromDate"><i class="fa fa-calendar"></i></label></span>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 form-group">
              <div class="input-group">
                <input id="toDate" type="text" name="toDate" value="<?php echo $toDate; ?>" class="form-control datepicker" placeholder="To Date" autocomplete="off" />
                <span class="input-group-addon"><label for="toDate"><i class="fa fa-calendar"></i></label></span>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 form-group">
              <input id="searchText" type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control" placeholder="Search Text"/>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 form-group">
              <button type="submit" class="btn btn-md btn-primary btn-block searchList pull-right"><i class="fa fa-search" aria-hidden="true"></i></button> 
            </div>
            <div class="col-lg-1 col-md-1 col-sm-6 col-xs-6 form-group">
              <!-- <button class="btn btn-md btn-default btn-block pull-right resetFilters"><i class="fa fa-refresh" aria-hidden="true"></i></button>-->
            </div>
          </form>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">user List</h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>userId</th>
                        <th>FullName</th>
                        <th>Mobile</th>
                        <th>CreatedDate</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->user_id ?></td>
                        <td><?php echo $record->fullname ?></td>
                        <td><p><b><?php echo $record->mobile ?></b></p></td>
                        <td><?php echo $record->createdDtm ?></td>
                        <td> 
                            <label class="label label-<?php if ($record->user_status =='1') {echo "success"; }else{ echo "warning"; } ?>">
                              <?php if ($record->user_status =='1') { echo "active";  }else{ echo "pending"; } ?>
                            </label>
                        </td>
                        <td class="text-center">
                            <?php if ($record->user_status =='0') {?>
                            <a class="btn btn-sm btn-success moveUser" href="#" data-user_id="<?php echo $record->user_id; ?>" data-user_status="1" title="move to success"><i class="fa fa-reply"></i> Accepted</a>
                            <?php }else{?>
                            <a class="btn btn-sm btn-warning moveUser" href="#" data-user_id="<?php echo $record->user_id; ?>" data-user_status="0" title="move to pending"><i class="fa fa-reply"></i> Pending</a>
                            <?php }?>
                            <a class="btn btn-sm btn-danger deleteCurrentUser" href="#" data-user_id="<?php echo $record->user_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>resource/backoffice/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>resource/backoffice/assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.datepicker').datepicker({
          autoclose: true,
          format : "yyyy-mm-dd"
        });
    });
</script>