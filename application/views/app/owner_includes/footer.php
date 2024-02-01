
    </div>
    
    
<!-- Success Error Modal -->
<div id="success_tic" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <a class="close" href="#" data-dismiss="modal">&times;</a>
            <div class="page-body">
                <h1 style="text-align:center;">
                    <div class="checkmark-circle">
                        <div class="background"></div>
                        <div class="checkmark draw"></div>
                    </div>
                </h1>
                <div class="head">  
                    <h3 style="margin-top:5px;" class="head-text">Updated Successfully</h3>
                </div>
            </div>
        </div>
    </div>
</div>


    <!--Modal: modallogout-->
    <div class="modal fade" id="modallogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-sm modal-notify modal-danger  modal-dialog-centered" role="document">
        <!--Content-->
        <div class="modal-content text-center">
          <!--Header-->
    
          <div class="modal-header d-flex justify-content-center">
            <p class="heading">Are you sure ?</p>     
          </div>
    
          <!--Body-->
          <div class="modal-body">
    
            <h4>Want to Logout ?</h4>  
    
          </div>
    
          <!--Footer-->
          <div class="modal-footer flex-center">
            <a href="<?php echo base_url('app/logoutOwner'); ?>" class="btn  btn-outline-danger flat-icon waves-effect waves-light">Yes</a>
            <a type="button" class="btn  btn-danger flat-icon waves-effect" data-dismiss="modal">No</a>
          </div>
    
        </div>
        <!--/.Content-->
      </div>
    </div>
    
    <!--Modal: modallogout-->

    
    <!--=== fixed js ===-->
    <script type="text/javascript" src="<?php echo base_url(); ?>resource/owner/js/bootstrap.min.js"></script> <!-- Bootstrap v3.3.7 -->

    <script src="<?php echo base_url(); ?>resource/owner/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>resource/owner/js/jquery-ui.js"></script>
    <!--=== custom js ===-->
    <script type="text/javascript" src="<?php echo base_url(); ?>resource/owner/js/custom.js"></script>
	
    
</body>
</html>