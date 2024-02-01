<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Coupon Management
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
                    <a class="btn btn-primary" href="<?php echo site_url(); ?>backoffice/coupon/addNew"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Coupon List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>backoffice/couponListing" method="POST" id="searchList">
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
                        <th>Coupon Title</th>
                        <th>Coupon Message</th>
                        <th>Coupon Code</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Coupon Status</th>
                        <th>Created On</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($couponRecords))
                    {
                        foreach($couponRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->coupon_title; ?></td>
                        <td><?php echo $record->coupon_description; ?></td>
                        <td><?php echo $record->coupon_code; ?></td>
                        <td><?php echo $record->start_date_time; ?></td>
                        <td><?php echo $record->end_date_time; ?></td>
                        <td> <label class="modify_class label label-<?php if ($record->coupon_status =='1') {echo "success"; }else{ echo "warning"; } ?>"><?php if ($record->coupon_status =='1') { echo "active";  }else{ echo "pending"; } ?></label>
                        </td>
                        <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td>
                        <td class="text-center">
                            <?php if ($record->coupon_status =='0') {?>
                            <a class="btn btn-sm btn-success moveCoupon" href="#" data-coupon_id="<?php echo $record->coupon_id; ?>" data-coupon_status="1" title="move to active list"><i class="fa fa-reply"></i> Active</a>
                            <?php }else{?>
                            <a class="btn btn-sm btn-warning moveCoupon" href="#" data-coupon_id="<?php echo $record->coupon_id; ?>" data-coupon_status="0" title="move to pending list"><i class="fa fa-reply"></i> Pending</a>
                            <?php }?>
                            | <a class="btn btn-sm btn-info" href="<?php echo base_url().'backoffice/coupon/editCoupon/'.$record->coupon_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-danger deleteCoupon" href="#" data-coupon_id="<?php echo $record->coupon_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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