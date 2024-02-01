<!-- Success Error Modal -->
<div id="success_tic" class="modal fade" role="dialog" style="z-index: 9999;">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content" style="border-radius:16px;">
            <a class="close" href="#" data-dismiss="modal">&times;</a>
            <div class="page-body">
                <h1 style="text-align:center;">
                    <div class="checkmark-circle">
                        <div class="background"></div>
                        <div class="checkmark draw"></div>
                    </div>
                </h1>
                <div class="head">  
                    <h3 class="head-text">Changes Successfully</h3>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal: View Order Modal -->
<div class="modal fade" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger  modal-dialog-centered" role="document" style="width: 100%;height: 100%;margin: 0;top: 0;left: 0;">
        <div class="modal-content text-center" style="width: 100%;height: 100%;">
            <div class="modal-header d-flex justify-content-center" style="padding: 5px;">
                <p class="heading">
                    <span data-dismiss="modal" class="back-icon waves-effect waves-circle" style="float: left; margin-right:20px;">
                           <a data-dismiss="modal" ><img width="21px" src="<?php echo site_url('resource/icons/arrow-left.svg');?>"/></a> 
                    </span>
                    <span class="app-pageTitle-text text-left">Order Details</span>
                </p>
            </div>
            <div class="modal-body" id="singleOrderDetails" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');"></div>

        </div>
    </div>
</div>



<!--Modal: View Order Modal-->
    
<!--Modal: Logout Modal -->
<div class="modal fade" id="modallogout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger  modal-dialog-centered" role="document">
        <div class="modal-content text-center">
        
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Are you sure ?</p>      
            </div>
            <div class="modal-body">
                <h3 class="text-center">Want to Logout ?</h3> 
            </div>
            <div class="modal-footer flex-center">
                <a href="<?php echo base_url('app/logoutUser'); ?>" class="btn  btn-outline-danger flat-icon waves-effect waves-light">Yes</a>
                <a type="button" class="btn  btn-danger flat-icon waves-effect" data-dismiss="modal">No</a>
            </div>
        
        </div>
    </div>
</div>
<!--Modal: Logout Modal-->