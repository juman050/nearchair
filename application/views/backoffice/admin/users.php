<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Administrative Management
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
            <div class="col-xs-6 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo site_url(); ?>backoffice/addNew"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Admins List</h3>
                    <div class="box-tools">
                        <form action="<?php echo site_url() ?>backoffice/userListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created On</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->name ?></td>
                        <td><?php echo $record->email ?></td>
                        <td><?php echo $record->mobile ?></td>
                        <td><?php echo $record->role ?></td>
                        <td><label class="modify_class label label-<?php if ($record->admin_status =='1') {echo "success"; }else{ echo "warning"; } ?>"><?php if ($record->admin_status =='1') { echo "active";  }else{ echo "pending"; } ?></label></td>
                        <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td>
                        <td class="text-center">
                            <?php if ($record->admin_status =='0') {?>
                            <a class="btn btn-sm btn-success moveAdmin" href="#" data-adminid="<?php echo $record->adminId; ?>" data-admin_status="1" title="move to success"><i class="fa fa-reply"></i> Accepted</a>
                            <?php }else{?>
                            <a class="btn btn-sm btn-warning moveAdmin" href="#" data-adminid="<?php echo $record->adminId; ?>" data-admin_status="0" title="move to pending"><i class="fa fa-reply"></i> Pending</a>
                            <?php }?>
                             | <a class="btn btn-sm btn-primary" href="<?= site_url().'login-history/'.$record->adminId; ?>" title="Login history"><i class="fa fa-history"></i></a> | 
                            <a class="btn btn-sm btn-info" href="<?php echo site_url().'backoffice/editUser/'.$record->adminId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger deleteUser" href="#" data-adminid="<?php echo $record->adminId; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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
<script type="text/javascript" src="<?php echo base_url(); ?>resource/backoffice/assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        
    });
</script>
