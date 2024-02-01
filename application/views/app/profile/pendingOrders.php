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
<link href="https://www.fontify.me/wf/c61fba03e48c28001e90eba4b87ca238" rel="stylesheet" type="text/css">

<section class="home-page-gategory-section" style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <?php
                    if($userOrders):
                        foreach($userOrders as $order):
                ?>
                <div class="single-order-box">
                    <a href="javascript:void(0)" data-order_id="<?php echo $order->order_id; ?>" class="view_order">
                        <p class="box-single-title"><?php echo substr($order->fullname, 0, 22) ; ?> <span class="pull-right"><?php echo $order->order_total; ?> Tk</span></p>
                        <p class="box-single-title-below"><?php echo date( 'd M Y | h:i a',strtotime($order->order_date)); ?> 
                        <?php if($order->order_type==0){ ?>
                            <span class="pull-right Pstatus">INSTANT</span>
                        <?php }elseif($order->order_type==1){ ?>
                            <span class="pull-right Astatus">ADVANCED</span>
                        <?php }else{ ?>
                            <span class="pull-right Pstatus">Unknown</span>
                        <?php } ?>

                        </p>
                    </a>
                </div>
                <?php              
                        endforeach;                     
                    else:
                ?>
                <div class="single-order-box">
                    <p class="box-single-title" style="text-align:center;">You have no order</p>
                </div>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</section>

   
<!-- Modal: View Order Modal -->
<div class="modal fade" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-notify modal-danger  modal-dialog-centered" role="document"  style="width: 100%;height: 100%;margin: 0;top: 0;left: 0;-webkit-transform: inherit !important;-moz-transform: inherit !important;-o-transform: inherit !important;transform: inherit !important;">
        <div class="modal-content text-center" style="width: 100%;height: 100%;">
            <div class="modal-header d-flex justify-content-center" style="padding: 10px 15px;">
                <p class="heading">
                    <span data-dismiss="modal" class="back-icon" style="float: left; margin-right:20px;">
                           <a data-dismiss="modal" ><img class="waves-image" height="26px" src="<?php echo site_url('resource/app/icon/left-back.png');?>"></a>
                    </span>
                    <span class="app-pageTitle-text text-left" style="float: left;">Order Details</span>
                </p>
            </div>
            <div class="modal-body" id="singleOrderDetails"  style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');"></div>
        </div>
    </div>
</div>
<!--Modal: View Order Modal-->

<script type="text/javascript" src="<?php echo base_url(); ?>/resource/owner/js/pages/profile.js"></script>
<script>
jQuery(function($){

        $(".view_order ").on("click",function(){
            var order_id = $(this).data('order_id');
            $.ajax({
               type: 'POST',
               dataType: 'html',
               url: baseURL+'app/singleBusinessOrderDetails',
               data: {order_id:order_id},
                // beforeSend: function() { $.LoadingOverlay("show"); },
                // complete: function() { $.LoadingOverlay("hide"); },
                success: function(response){
                    // $('#modalDetails').find('.modal_order_id').text(order_id);
                    $('#singleOrderDetails').html(response);
                    $('#modalDetails').modal('show');
               }
            });
        });

    });
</script>
