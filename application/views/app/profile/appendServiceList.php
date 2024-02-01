<link href="https://www.fontify.me/wf/c61fba03e48c28001e90eba4b87ca238" rel="stylesheet" type="text/css">
<div class="appendSer">
    <?php 
    $count = 0;
    foreach ($seviceCategory as $s_Category):  ?>

          <div class="panel-group" id="accordion">
            <div class="panel panel-default" style="margin-bottom: 0px;">

              <div class="panel-heading <?php if($count==0){ ?> active <?php } ?>" role="tab">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$count;?>" <?php if($count==0){ ?> aria-expanded="true" <?php } ?>><?php echo $s_Category->category_name.' (<span class="serviceTotal-'.$s_Category->cat_id.'">'.$s_Category->totalNumber.'</span>)'; ?></a>
                </h4>
              </div>
              <div id="collapse<?=$count;?>" class="panel-collapse collapse <?php if($count==0){ ?> in <?php } ?>" <?php if($count==0){ ?> aria-expanded="true" <?php } ?>>
                <div class="panel-body">
                    <ul class="item list-unstyled hair-ul">

                    <?php 

                    if(!empty($seviceList)){
                        ?>
                        
                        <?php
                        foreach ($seviceList as $s_list){
                            if($s_list->cat_id == $s_Category->cat_id){
                        
                    ?>

                        <li class="item-list" id="item-<?php echo $s_list->service_id; ?>">

                            <span class="item-name"><?php echo $s_list->service_name; ?></span>

                            <span class="item-price"><?php echo $s_list->service_price; ?> TK</span>

                            <span class="add-to-cart">
                                <a href="javascript:void(0)" data-cat_id="<?php echo $s_list->cat_id; ?>" data-id="<?php echo $s_list->service_id; ?>" data-business_id="<?php echo $s_list->business_id; ?>" class="view_service">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </span>&nbsp;&nbsp;<span class="add-to-cart">
                                <a href="javascript:void(0)" data-cat_id="<?php echo $s_list->cat_id; ?>" data-id="<?php echo $s_list->service_id; ?>" data-business_id="<?php echo $s_list->business_id; ?>" class="delete_service">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </span>
                        </li>

                    <?php 
                            }
                        }
                        ?>
                        <p class="stle_p"><span href="javascript:void(0)" class="form-control btn btn-xs btn-cus add_service_by_cat" data-cat_id="<?=$s_Category->cat_id;?>">Add new service</span></p>
                        <?php
                    }

                    ?>
                    </ul>
                </div>
              </div>



            </div>
          </div>

    <?php 
    $count++;
    endforeach;  ?>
</div>

<script type="text/javascript">

    jQuery(function($){

        function getservices(){

            $.ajax({
                type: 'GET',
                dataType: 'html',
                url: baseURL+'app/singleBusinessServices',
                contentType: false,
                processData: false,
                success: function(response){
                    $('.appendSer').html(response);
               }
            });

        };

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