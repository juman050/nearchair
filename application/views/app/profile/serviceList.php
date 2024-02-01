<link rel="stylesheet" href="<?php echo base_url(); ?>resource/user/css/user.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">
<link href="https://www.fontify.me/wf/c61fba03e48c28001e90eba4b87ca238" rel="stylesheet" type="text/css">
<style>
    .error{font-size:15px;}
    /*label{left: 16px !important;}*/
</style>
<?php if($global_business_id): ?>
<script>
    var global_business_id = '<?php echo $global_business_id; ?>';
</script>
<?php else: ?>
<script>
    var global_busines_id = '';
</script>
<?php endif; ?>

<section class="home-page-gategory-section" style="min-height:100vh;padding-top:50px;background:url('<?php echo base_url() ?>resource/app/icon/bg.png');">
    <div class="container">
        <!--<div class="row">-->
            
        <!--    <div class="col-md-12">-->
        <!--        <?php if(!empty($allcategories)): ?>-->
        <!--        <form action="" method="POST">-->

        <!--            <select name="cat_id">-->
        <!--                <?php foreach($allcategories as $allcategory): ?>-->
        <!--                <option value="<?php echo $allcategory->category_id; ?>"><?php echo $allcategory->category_name; ?></option>-->
        <!--                <?php endforeach; ?>-->
        <!--            </select>-->

        <!--        </form>-->
        <!--        <?php else: ?>-->
        <!--            <p class="text-center">No Data</p>-->
        <!--        <?php endif; ?>-->
        <!--    </div>-->
            
        <!--</div>-->
        <div class="row">
            
            <div class="col-md-12">
                <div class="panel panel-default">

                    <?php if(!empty($seviceCategory)): ?>
                    <div id="collapseService" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="serviceList">
                        <div class="panel-body" id="service_list">


                        </div>
                    </div>
                    <?php else: ?>
                        <p class="text-center">No Data</p>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>
</section>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" 
         aria-labelledby="addServiceModal" aria-hidden="true">
        <div class="modal-dialog" style="width: 100%;height: 100%;margin: 0;top: 0;left: 0;-webkit-transform: inherit !important;-moz-transform: inherit !important;-o-transform: inherit !important;transform: inherit !important;">
            <div class="modal-content" style="width: 100%;height: 100%;">
                
            <!-- Modal Header -->
            <div class="modal-header d-flex justify-content-center" style="padding: 5px;background-color: #f95765;background-image: linear-gradient(to right, #fc6ba6 , #09b1e3);">

                    <p class="heading">
                        <span data-dismiss="modal" class="back-icon" style="float: left; margin-right:20px;">
                               <a data-dismiss="modal" ><img width="21px" src="<?php echo site_url('resource/icons/arrow-left.svg');?>"/></a> 
                        </span>
                        <span class="app-pageTitle-text text-left">Add Service</span>
                    </p>
            </div>
                

                <!-- Modal Body -->
                <div class="modal-body" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');">
                        
                    <form class="form-horizontal" role="form" id="serviceForm" action="" method="POST" style="padding-top:20px;">
        
                        <div style="background: #FFFFFF;padding: 30px 10px 10px 10px;;border-radius: 10px;margin-bottom: 35px;min-height:420px;">
                        <?php if(!empty($allbusinesses)): ?>
            
                          <input type="hidden" name="business_id" id="business_id" class="form-control" value="<?php echo 
                          $allbusinesses[0]->business_id;  ?>" required="required" >
            
            
                        <?php endif; ?>
        
                        <div class="group">      
                            <input  type="text"  placeholder="Service Name" name="service_name" id="service_name" required  >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
                        
                        <div class="group">
                            <select name="cat_id" id="cat_id" required>
                                <option value="">Select Category</option>
                                <?php 
    
                                    if($allcategories){
                                        foreach ($allcategories as $category) {  ?>
                                    
                                        <?php 
                                        
                                        if($allbusinesses[0]->business_type==1){
                                            if($category->category_type==1 || $category->category_type==3){ ?>
                                            <option value="<?=$category->category_id?>"><?=$category->category_name?></option>
                                        <?php 
                                            }
                                        }elseif($allbusinesses[0]->business_type==2){
                                            if($category->category_type==2 || $category->category_type==3){
                                        ?>
                                        <option value="<?=$category->category_id?>"><?=$category->category_name?></option>
                                        <?php 
                                            }
                                        }else{ ?>
                                            <option value="<?=$category->category_id?>"><?=$category->category_name?></option>
                                        <?php
                                        }
                                        ?>
                                    
                                    <?php
                                        }
                                    }
    
                                ?>
                            </select>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
                        
                        <div class="group">
                            <textarea rows="3" id="service_description" name="service_description" placeholder="Description..." ></textarea>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
                        
                        <div class="group" style="width: 40%;float: left;margin-left: 19px;">      
                            <input  type="text"  placeholder="Price" name="service_price" id="service_price" required  >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
    
                        <div class="group" style="width: 41%;float: left;margin-left: 25px;">      
                            <input  type="text"  placeholder="Discount Price" name="service_discount_price" id="service_discount_price"  >
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
                    
                        <div class="group" style="width: 40%;float: left;margin-left: 19px;">      
                            <select id="service_time_hr" name="service_time_hr" required="required">
                                <option value="">Hr</option>
                                <?php for($i=0;$i<24;$i++){ 
    
                                        if($i<10){
                                          $count = 0;
                                        }else{
                                          $count="";
                                        }
    
                                    ?>
                                    <option value="<?php echo $count.$i; ?>"><?php echo $count.$i; ?></option>
                                <?php } ?>
                                
                            </select>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
                        <div class="group" style="width: 41%;float: left;margin-left: 25px;">      
                            <select id="service_time_min" name="service_time_min" required="required">
                                <?php for($j=0;$j<60;$j++){ 
    
                                        if($j<10){
                                          $count2 = 0;
                                        }else{
                                          $count2="";
                                        }
    
                                    ?>
                                    <option value="<?php echo $count2.$j; ?>"><?php echo $count2.$j; ?></option>
                                <?php } ?>
                            </select>
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label></label>
                        </div>
                        

                        </div>
                        
                        <button id="submit_btn" type="submit" class="add_service">ADD</button>
                        <br>
                    </form>
                        
                        
                </div>
            </div>
        </div>
    </div>
    
    
    
    <!-- Edit Modal -->
    <div class="modal fade" id="myServiceModal" tabindex="-1" role="dialog" 
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog"  style="width: 100%;height: 100%;margin: 0;top: 0;left: 0;-webkit-transform: inherit !important;-moz-transform: inherit !important;-o-transform: inherit !important;transform: inherit !important;">
            <div class="modal-content" style="width: 100%;height: 100%;">
                <!-- Modal Header -->
                <div class="modal-header d-flex justify-content-center" style="padding: 5px;background-color: #f95765;background-image: linear-gradient(to right, #fc6ba6 , #09b1e3);">
                    <p class="heading">
                        <span data-dismiss="modal" class="back-icon" style="float: left; margin-right:20px;">
                               <a data-dismiss="modal" ><img width="21px" src="<?php echo site_url('resource/icons/arrow-left.svg');?>"/></a> 
                        </span>
                        <span class="app-pageTitle-text text-left">Edit Service</span>
                    </p>
                </div>
                
                <!-- Modal Body -->
                <div class="modal-body" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');">
                        
                    <form class="form-horizontal" role="form" id="editServiceForm" action="" method="POST" style="padding-top:20px;">
        
                        <div style="background: #FFFFFF;padding: 30px 10px 10px 10px;;border-radius: 10px;margin-bottom: 35px;min-height:420px;">
                            
                            <?php if(!empty($allbusinesses)): ?>
                
                              <input type="hidden" name="business_id" id="business_id" class="form-control" value="<?php echo 
                              $allbusinesses[0]->business_id;  ?>" required="required" >
                
                              <input type="hidden" name="service_id" id="service_id" class="form-control service_id" required="required" value="">
                
                            <?php endif; ?>
    
                            <div class="group">      
                                <input  type="text"  placeholder="Service Name" name="service_name" id="service_name" required  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label></label>
                            </div>
    
                            <div class="group">
                                <select name="cat_id" id="cat_id" required>
                                    <option value="">Select Category</option>
                                        
                                    <?php 
        
                                        if($allcategories){
                                            foreach ($allcategories as $category) {  ?>
                                        
                                            <?php 
                                            
                                            if($allbusinesses[0]->business_type==1){
                                                if($category->category_type==1 || $category->category_type==3){ ?>
                                                <option value="<?=$category->category_id?>"><?=$category->category_name?></option>
                                            <?php 
                                                }
                                            }elseif($allbusinesses[0]->business_type==2){
                                                if($category->category_type==2 || $category->category_type==3){
                                            ?>
                                            <option value="<?=$category->category_id?>"><?=$category->category_name?></option>
                                            <?php 
                                                }
                                            }else{ ?>
                                                <option value="<?=$category->category_id?>"><?=$category->category_name?></option>
                                            <?php
                                            }
                                            ?>
                                        
                                        <?php
                                            }
                                        }
        
                                    ?>
                                </select>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label></label>
                            </div>
                            
                            <div class="group">
                                <textarea rows="3" id="service_description" name="service_description" placeholder="Description..." ></textarea>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label></label>
                            </div>
                            
                            <div class="group" style="width: 40%;float: left;margin-left: 19px;">      
                                <input  type="text" placeholder="Price" name="service_price" id="service_price" required  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label></label>
                            </div>
        
                            <div class="group" style="width: 41%;float: left;margin-left: 25px;">      
                                <input  type="text"  placeholder="Discount Price" name="service_discount_price" id="service_discount_price"  >
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label></label>
                            </div>
                        
                            <div class="group" style="width: 40%;float: left;margin-left: 19px;">      
                                <select id="service_time_hr" name="service_time_hr" required="required">
                                    <option value="">Hr</option>
                                    <?php for($i=0;$i<24;$i++){ 
        
                                            if($i<10){
                                              $count = 0;
                                            }else{
                                              $count="";
                                            }
        
                                        ?>
                                        <option value="<?php echo $count.$i; ?>"><?php echo $count.$i; ?></option>
                                    <?php } ?>
                                    
                                </select>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label></label>
                            </div>
                            <div class="group"  style="width: 41%;float: left;margin-left: 25px;">      
                                <select id="service_time_min" name="service_time_min" required="required">
                                    <?php for($j=0;$j<60;$j++){ 
        
                                            if($j<10){
                                              $count2 = 0;
                                            }else{
                                              $count2="";
                                            }
        
                                        ?>
                                        <option value="<?php echo $count2.$j; ?>"><?php echo $count2.$j; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label></label>
                            </div>

                        </div>
                        
                        <button id="submit_btn" type="submit" class="edit_service">Update</button>
                        <br>
                    </form>
                        
                        
                </div>
            </div>
        </div>
    </div>
    

    
    <!--Modal: modalConfirmDeleteService-->
    <div class="modal fade" id="modalConfirmDeleteService" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-sm modal-notify modal-danger modal-dialog-centered" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
          <form id="deleteServiceForm">
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">Are you sure?</p>
                <input type="hidden" name="id" class="id">
                <input type="hidden" name="business_id" class="business_id">        
                <input type="hidden" name="cat_id" class="cat_id">        
          </div>
    
          <!--Body-->
          <div class="modal-body">
    
            <h2>Want to Delete This ?</h2>
    
          </div>
    
          <!--Footer-->
          <div class="modal-footer flex-center">
            <a href="javascript:void(0)" class="btn  btn-outline-danger flat-icon waves-effect waves-light do_delete_service">Yes</a>
            <a type="button" class="btn  btn-danger flat-icon waves-effect" data-dismiss="modal">No</a>
          </div>
          </form>
        </div>
        <!--/.Content-->
      </div>
    </div>
    
    <!--Modal: modalConfirmDeleteService-->
    
<script type="text/javascript" src="<?php echo base_url(); ?>/resource/owner/js/pages/profile.js"></script>
<script>
jQuery(function($){
  
    getservices();

    function getservices(){

        $.ajax({
            type: 'GET',
            dataType: 'html',
            url: baseURL+'app/singleBusinessServices',
            contentType: false,
            processData: false,
            success: function(response){
                $('#service_list').html(response);
           }
        });

    }

        $(".delete_service").on("click",function(){

            $('#modalConfirmDeleteService').modal('show');
            $('#modalConfirmDeleteService').find('#deleteServiceForm').find('.id').val($(this).data('id'));
            $('#modalConfirmDeleteService').find('#deleteServiceForm').find('.business_id').val($(this).data('business_id'));
            $('#modalConfirmDeleteService').find('#deleteServiceForm').find('.cat_id').val($(this).data('cat_id'));

        });

        $("#deleteServiceForm").on("click",".do_delete_service",function(){
            var id = $('.id').val();
            var business_id = $('.business_id').val();
            var cat_id = $('.cat_id').val();
            var serviceTotal = $('.serviceTotal-'+cat_id).text();
            if(id)
            {
                $.ajax({
                    url: baseURL+'app/deleteService',
                    dataType: 'html',
                    method: 'GET',
                    // beforeSend: function() { $.LoadingOverlay("show"); },
                    // complete: function() { $.LoadingOverlay("hide"); },
                    data: {id:id,business_id:business_id},
                    success: function(data){
                        $('#modalConfirmDeleteService').modal('hide');
                        $('#success_tic').modal('show');
                        $('#success_tic').find('.head-text').html(data);
                        $('#item-'+id).hide();
                        $('.serviceTotal-'+cat_id).text(--serviceTotal);
                    }

                });
            }
        });

        $(".add_service_by_cat").on("click",function(){
            var cat_id = $(this).data('cat_id');
            if(cat_id)
            {
                $('#addServiceModal').modal('show');
                $('#addServiceModal').find('#cat_id').val(cat_id);
            }
        });
        
        $("#service_name").autocomplete({
            source: baseURL+'app/suggestionService'
        });
    
        if ($("#serviceForm").length > 0) {
            $("#serviceForm").validate({
              
            rules: {
                service_name: 'required',
                cat_id: {
                     required: true,  
                     number: true,          
                    },
                service_price: {
                     required: true,
                     number: true,
                    },
                service_time_hr: {
                     required: true,
                    },
               
            },
            messages: {
                service_name: "Name Must be field!", 
                cat_id: {
                    required:"Category must be fillup!",
                    number: 'Must enter digits',
                },    
                service_price: {
                    required:"Price digits",
                    number: 'Must enter Number',
                },
                service_time_hr: {
                    required: "Hour is required!",
                }
              
            },
            submitHandler: function(form) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: baseURL+'app/add_service',
                    data: $('#serviceForm').serialize(),
                    // beforeSend: function() { $.LoadingOverlay("show"); },
                    // complete: function() { $.LoadingOverlay("hide"); },
                    success: function(response){
                        $('#success_tic').modal('show');
                        $('#success_tic').find('.head-text').html(response.msg);
                        $('#serviceForm')[0].reset();
                        $('#addServiceModal').modal('hide');
                        getservices();
                   }
                });
            }
          })
        }
       
        $(".view_service").on("click",function(){

            var id = $(this).data('id');
            var business_id = $(this).data('business_id');
            var cat_id = $(this).data('cat_id');
            var id = $(this).data('id');
            if(id)
            {
                $.ajax({
                    url: baseURL+'app/getSingleService',
                    dataType: 'json',
                    method: 'get',
                    // beforeSend: function() { $.LoadingOverlay("show"); },
                    // complete: function() { $.LoadingOverlay("hide"); },
                    data: {id:id,business_id:business_id},
                    success: function(data){

                        $('#myServiceModal').modal('show');

                        var service_id = data[0].service_id;
                        var cat_id = data[0].cat_id;
                        var service_description = data[0].service_description;
                        var serviceName = data[0].service_name;
                        var service_price = data[0].service_price;
                        var service_discount_price = data[0].service_discount_price;
                        var service_time = data[0].service_time;

                        var HrMin = service_time.split(':');
                        var hr = HrMin[0];
                        var min = HrMin[1];

                        $('#myServiceModal').find('.modal-title').text('Edit '+serviceName+' Service');
                        $('#myServiceModal').find('#service_id').val(service_id);
                        $('#myServiceModal').find('#cat_id').val(cat_id);
                        $('#myServiceModal').find('#service_time_hr').val(hr);
                        $('#myServiceModal').find('#service_time_min').val(min);
                        $('#myServiceModal').find('#service_name').val(serviceName);
                        $('#myServiceModal').find('#service_price').val(service_price);
                        $('#myServiceModal').find('#service_discount_price').val(service_discount_price);
                        $('#myServiceModal').find('#service_description').val(service_description);

                    }

                });
            }
        });

        if ($("#editServiceForm").length > 0) {
            $("#editServiceForm").validate({
              
            rules: {
                service_name: 'required',
                cat_id: {
                     required: true,  
                     number: true,          
                    },
                service_price: {
                     required: true,
                     number: true,
                    },
                service_time_hr: {
                     required: true,
                    },
               
            },
            messages: {
                service_name: "Name Must be field!",
                cat_id: {
                    required:"Category must be fillup!",
                    number: 'Must enter Number',
                },    
                service_price: {
                    required:"Price required",
                    number: 'Must enter Number',
                },
                service_time_hr: {
                    required: "Time is required!",
                },
            },
            submitHandler: function(form) {

                var formData = new FormData($('#editServiceForm')[0]);
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: baseURL+'app/editService',
                    data: formData,
                    // beforeSend: function() { $.LoadingOverlay("show"); },
                    // complete: function() { $.LoadingOverlay("hide"); },
                    contentType: false,
                    processData: false,
                    success: function(response){
                        $('#myServiceModal').modal('hide');
                        $('#editServiceForm')[0].reset();
                        $('#success_tic').modal('show');
                        $('#success_tic').find('.head-text').html(response.msg);
                        getservices();
                   }
                });
            }
          })
        }
});
</script>
