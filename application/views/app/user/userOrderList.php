<link rel="stylesheet" href="<?php echo base_url(); ?>resource/user/css/user.css">
<link href="https://www.fontify.me/wf/c61fba03e48c28001e90eba4b87ca238" rel="stylesheet" type="text/css">

<section class="home-page-gategory-section" style="padding-top:65px;background:url('<?php echo base_url() ?>resource/app/icon/bg.png');min-height: 100vh;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <?php
                    if($userOrders):
                        foreach($userOrders as $order):
                ?>
                <div class="single-order-box">
                    <a href="javascript:void(0)" data-order_id="<?php echo $order->order_id; ?>" class="view_order">
                        <p class="box-single-title"><?php echo substr($order->business_name, 0, 22) ; ?> <span class="pull-right"><?php echo $order->order_total; ?> Tk</span></p>
                        <p class="box-single-title-below"><?php echo date( 'd M Y | h:i a',strtotime($order->order_date)); ?> 
                        <?php if($order->order_status==0){ ?>
                            <span class="pull-right Pstatus">PENDING</span>
                        <?php }elseif($order->order_status==1){ ?>
                            <span class="pull-right Astatus">ACCEPTED</span>
                        <?php }elseif($order->order_status==2){ ?>
                            <span class="pull-right Cstatus">CANCELLED</span>
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
                    <p class="box-single-title" style="text-align:center;">You Didn't any order yet</p>
                </div>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</section>

   
<script src="<?php echo base_url(); ?>resource/user/js/user.js" type="text/javascript"></script>

<?php $this->load->view('app/user/modals'); ?>