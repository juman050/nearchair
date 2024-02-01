<link rel="stylesheet" href="<?php echo base_url(); ?>resource/user/css/user.css">
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
                <div class="form-group" id="appendImages">
                    <?php if($allbusinesses[0]->gallery_image): ?>
                        <div class="col-sm-12" style="padding:0px;">
                            <?php foreach($allbusinesses[0]->gallery_image as $gallery): ?>
                            <div class="gallery-img-wrap">
                                <span class="delete_gallery_image image-<?php echo $gallery->gallery_id; ?>" data-gallery_id="<?php echo $gallery->gallery_id; ?>">&times;</span>

                                <img class="image-<?php echo $gallery->gallery_id; ?>" src="<?php echo site_url().'resource/app/images/gallery/'.$gallery->image; ?>" id="gallery_image-id" style="width: 140px;height: 94px;" />
                            </div>
                            
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <form enctype="multipart/form-data" class="form-inline" style="border-top: 1px solid #3e3535;padding-top: 20px;" id="galleryForm">
                    
                    <div class="form-group">
                        <div class="col-sm-12">
                            <!--<input style="width: 75%;float: left;" type="file" class="form-control" id="gallery_image" name="gallery_image[]" multiple="multiple" id="gallery_image" required="required">-->
                            <div class="emon_dsgn_upload">
                              <div class="file-upload">
                                <input type="file" name="gallery_image[]" multiple="multiple" id="gallery_image" />Upload Image
                              </div>
                            </div>
                            <input type="hidden" class="form-control" name="business_id" id="business_id" required="required" value="<?php echo $allbusinesses[0]->business_id; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3">
                            <button type="submit" name="ADD" class="btn btn-md btn-cus form-control" style="line-height: 0;">ADD</button>
                            <br><br>
                        </div>
                    </div>

                </form>
                <?php else: ?>
                    <p class="text-center">Your Business Is Pending Yet</p>
                <?php endif; ?>

            </div>
            
        </div>
    </div>
</section>
<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <form id="deleteForm">
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Are you sure?</p>
            <input type="hidden" name="gallery_id" class="gallery_id">     
      </div>

      <!--Body-->
      <div class="modal-body">

        <h2 class="text-center">Want to Delete</h2>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        <a href="javascript:void(0)" class="btn  btn-outline-danger flat-icon waves-effect waves-light do_delete">Yes</a>
        <a type="button" class="btn  btn-danger flat-icon waves-effect" data-dismiss="modal">No</a>
      </div>
      </form>
    </div>
    <!--/.Content-->
  </div>
</div>

<!--Modal: modalConfirmDelete-->
<script type="text/javascript" src="<?php echo base_url(); ?>/resource/owner/js/pages/profile.js"></script>
<script>
window.onunload = function() { debugger; }
jQuery(function($){
    
    
        if ($("#galleryForm").length > 0) {
        $("#galleryForm").validate({
          
        rules: {
            gallery_image: 'required',
            business_id: 'required',
        },
        messages: {
            gallery_image: "Select images",
            business_id: "What are you doing ?",
        },
        submitHandler: function(form) {
            
            var formData = new FormData($('#galleryForm')[0]);
            $.ajax({
                type: 'POST',
                dataType: 'html',
                url: baseURL+'app/add_gallery_image',
                data: formData,
                contentType: false,
                processData: false,
                // beforeSend: function() { $.LoadingOverlay("show"); },
                // complete: function() { $.LoadingOverlay("hide"); },
            })
            .done(function(response) {
                
                if(response=='false'){
                    $('#success_tic').modal('show');
                    $('#success_tic').find('.head-text').html('Select an image');
                }else{
                    $('#success_tic').modal('show');
                    $('#success_tic').find('.head-text').html(response);
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }

            })
            .fail(function(response) {
                $('#success_tic').modal('show');
                $('#success_tic').find('.head-text').html('Size is too Large. You can upload one by one.');
            })
            .always(function() {
                console.log("complete");
            }); 
            
        }
      })
    }
        $(".delete_gallery_image").on("click",function(){
            $('#modalConfirmDelete').modal('show');
            $('#modalConfirmDelete').find('#deleteForm').find('.gallery_id').val($(this).data('gallery_id'));
        });
        

        $("#deleteForm").on("click",".do_delete",function(){
            var gallery_id = $('.gallery_id').val();
            if(gallery_id)
            {
                $.ajax({
                    url: baseURL+'app/deleteGalleryImage',
                    dataType: 'html',
                    method: 'POST',
                    // beforeSend: function() { $.LoadingOverlay("show"); },
                    // complete: function() { $.LoadingOverlay("hide"); },
                    data: {'gallery_id':gallery_id},
                    success: function(data){
                         $('#modalConfirmDelete').modal('hide');
                         $('#success_tic').modal('show');
                         $('#success_tic').find('.head-text').html(data);
                         $('.image-'+gallery_id).hide();
                    }

                });
            }
        });
        

});
</script>
