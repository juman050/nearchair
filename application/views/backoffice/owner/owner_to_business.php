<link href="<?php echo base_url(); ?>resource/backoffice/assets/plugins/choosen/choosen.css" rel="stylesheet" type="text/css"></link>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-owners"></i> Add Business To Owner
        <small>Add, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-xs-6">
                <div class="row">
                    <form role="form" id="addOwner" action="<?php echo site_url() ?>backoffice/addOwnersBusiness" method="post" role="form">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="owner_id">Owners</label>
                            <select class="form-control chosen required" id="owner_id" name="owner_id">
                                <?php
                                if(!empty($owners_data))
                                { foreach($owners_data as $owner) {?>
                                    <option value="<?= $owner->owner_id;?>" selected><?= $owner->owner_email;?></option>
                                <?php } }else{?>
                                <option value="">No data found.</option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="business_id">Business</label>
                            <select class="form-control chosen required" id="business_id" name="business_id">
                                <?php
                                if(!empty($businesses_data))
                                { foreach($businesses_data as $business) {?>
                                    <option value="<?= $business->business_id;?>" selected><?= $business->business_name;?></option>
                                <?php } }else{?>
                                <option value="">No data found.</option>
                                <?php }?>
                                
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for=""></label>
                            <input type="submit" class="btn btn-success" value="Add" />
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class=" col-md-4 col-xs-6">
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
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Owners Business List</h3>
                    <div class="box-tools">
                        <form action="<?php echo site_url() ?>backoffice/ownersBusiness" method="POST" id="searchList">
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
                <?php
                    if(!empty($ownersBusinessRecords)){
                    ?>
                    <table class="table table-hover">
                        <tr>
                            <th>Owner Email</th>
                            <th>Business Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        <?php
                        foreach($ownersBusinessRecords as $record){
                        ?>
                        <tr>
                            <td><?php echo $record->owner_email ?></td>
                            <td><?php echo $record->business_name ?></td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-danger deleteOwnerBusiness" href="#" data-id="<?php echo $record->id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                    <?php
                        }else{
                    ?>
                    
                    <?php }?>
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
<script type="text/javascript" src="<?php echo base_url(); ?>resource/backoffice/assets/plugins/choosen/choosen.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "ownerListing/" + value);
            jQuery("#searchList").submit();
        });
        //This function is used to delete the owner business from the system
    	jQuery(document).on("click", ".deleteOwnerBusiness", function(){
    		var id = $(this).data("id"),
    			hitURL = baseURL + "backoffice/deleteOwnersBusiness",
    			currentRow = $(this);
    		
    		var confirmation = confirm("Are you sure to delete this user ?");
    		
    		if(confirmation)
    		{
    			jQuery.ajax({
    			type : "POST",
    			dataType : "json",
    			url : hitURL,
    			data : { id : id } 
    			}).done(function(data){
    				console.log(data);
    				currentRow.parents('tr').remove();
    				if(data.status = true) { alert("Connection successfully deleted"); }
    				else if(data.status = false) { alert("Connection deletion failed"); }
    				else { alert("Access denied..!"); }
    			});
    		}
    	});
    });
</script>
<script type="text/javascript">
    $(".chosen").chosen();
</script>