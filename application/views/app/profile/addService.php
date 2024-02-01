<link rel="stylesheet" href="<?php echo base_url(); ?>resource/user/css/user.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">
<style>
    .error{font-size:15px;}
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

<section class="home-page-gategory-section" style="min-height:100vh;background:url('<?php echo base_url() ?>resource/app/icon/bg.png');">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                    <?php if(!empty($allbusinesses)): ?>
                    <form id="serviceForm">

                    <div style="background: #FFFFFF;padding: 30px 10px 10px 10px;;border-radius: 10px;margin-bottom: 35px;min-height:420px;">
                    <input type="hidden" name="business_id" id="business_id" class="form-control" value="<?php echo $allbusinesses[0]->business_id;  ?>" required="required">
                     
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
                    <button id="submit_btn" type="submit" class="waves-effect waves-float add_service" style="display: block;">Submit</button>
                    <br>
                    </form>
                    <?php else: ?>
                        <p class="text-center">Your Business Is Pending Yet</p>
                    <?php endif; ?>
            </div>
            
        </div>
    </div>
</section>


<script type="text/javascript" src="<?php echo base_url(); ?>/resource/owner/js/pages/profile.js"></script>
<script>
jQuery(function($){
    
    if (!elem.getClientRects()) {
        return { top: 0, left: 0 };
    }

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
               }
            });
        }
      })
    }


});
</script>
