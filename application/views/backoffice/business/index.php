<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Business Management
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
                    <a class="btn btn-primary" href="<?php echo site_url(); ?>backoffice/business/addNew"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">business List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>businessListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <input type="hidden" name="uri_segment" value="<?= $this->uri->segment(3);?>">
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                <?php if(!empty($businessRecords))
                    { ?>
                  <table class="table table-hover">
                    <tr>
                        <th width="14%">Business Name</th>
                        <th width="18%">Address</th>
                        <th width="10%">Phone</th>
                        <!--<th width="10%">Email</th>-->
                        <th width="8%">Status</th>
                        <th width="9%">CreatedOn</th>
                        <th class="text-center" width="42%">Actions</th>
                    </tr>
                    <?php
                        foreach($businessRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->business_name ?></td>
                        <td><?php echo $record->address ?></td>
                        <td><?php echo $record->mobile_number ?></td>
                        <!--<td><?php echo $record->email ?></td>-->
                        <td> <label class="label label-<?php if ($record->business_status =='0') {echo "warning"; }elseif ($record->business_status =='1') {echo "success"; }else{ echo "danger"; } ?>"><?php if ($record->business_status =='0') {echo "Pending"; }elseif ($record->business_status =='1') { echo "Accepted";  }else{ echo "Cancelled"; } ?></label>
                        </td>
                        <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td>
                        <td class="text-center">
                        <?php if ($record->business_status =='0') {?>
                            <a class="btn btn-sm btn-success moveBusiness" href="#" data-business_id="<?php echo $record->business_id; ?>" data-business_status="1" title="move to success"><i class="fa fa-reply"></i> Accepted</a>
                            <a class="btn btn-sm btn-danger moveBusiness" href="#" data-business_id="<?php echo $record->business_id; ?>" data-business_status="2" title="move to cancelled"><i class="fa fa-reply"></i> Cancelled</a>
                        <?php }elseif($record->business_status =='1') {?>
                            <a class="btn btn-sm btn-warning moveBusiness" href="#" data-business_id="<?php echo $record->business_id; ?>" data-business_status="0" title="move to pending"><i class="fa fa-reply"></i> Pending</a>
                            <a class="btn btn-sm btn-danger moveBusiness" href="#" data-business_id="<?php echo $record->business_id; ?>" data-business_status="2" title="move to cancelled"><i class="fa fa-reply"></i> Cancelled</a>
                        <?php }else{ ?>
                            <a class="btn btn-sm btn-warning moveBusiness" href="#" data-business_id="<?php echo $record->business_id; ?>" data-business_status="0" title="move to pending"><i class="fa fa-reply"></i> Pending</a>
                            <a class="btn btn-sm btn-success moveBusiness" href="#" data-business_id="<?php echo $record->business_id; ?>" data-business_status="1" title="move to success"><i class="fa fa-reply"></i> Accepted</a>
                        <?php } ?>
                            | <a class="btn btn-sm btn-info" href="<?php echo site_url().'backoffice/business/editBusiness/'.$record->business_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger deleteBusiness" href="#" data-business_id="<?php echo $record->business_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                            <a class="btn btn-sm btn-success" href="<?php echo site_url().'backoffice/business/addService/'.$record->business_id; ?>" title="Add Service">Add Service</i></a>
                        </td>
                    </tr>
                    <?php
                        }
                   
                    ?>
                  </table>
              <?php } else{ ?>
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        No data found.                
                    </div>
                </div>
              <?php } ?>
                  
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
