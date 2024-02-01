<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> <?php echo getBusinessName($orderInfo[0]->business_id); ?>
        <!--<i class="fa fa-users"></i> -->
        <!--<small>Add / Edit Area</small>-->
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-5">
                <div class="ordersTable" style="background: #ffffff;border-radius: 19px;padding: 15px 10px;height:auto;">
                
                    <p style="color: #202023;font-size: 20px;font-family: font92726;"><?php echo $orderInfo[0]->fullname; ?></p>
                    <p style="color: #717171;font-size: 16px;font-family: font92726;"><?php echo ($orderInfo[0]->user_address!="") ? $orderInfo[0]->user_address : ''; ?></p>
                    <p style="color: #717171;font-size: 16px;"><?php echo date( 'M d, Y h:i a',strtotime($orderInfo[0]->order_date)); ?></p>
                    <p style="color: #202023;font-size: 18px;font-family: font92726;">Order ID : <?php echo $orderInfo[0]->order_id; ?></p>
                    
                
                    <p style="color: #202023;font-size: 20px;font-family: font92726;text-align:left;">Service Info</p>
                    
                    <table class="table ordersTable" style="background: #ffffff;">
                
                        <tbody>
                    
                            <?php 
                            
                                $totalServicePrice = 0;
                                if($orderServices){
                                    foreach($orderServices as $services){
                                        $totalServicePrice = $services->service_price + $totalServicePrice;
                            ?>
                    
                            <tr>
                                <td class="tblTD"><span class="common_data_left"><?php echo $services->service_name; ?></span></td>
                                <td class="tblTD"><span class="common_data_right"><?php echo $services->service_price; ?> TK</span></td>
                            </tr>
                            
                            <?php
                                    }
                                }
                            ?>
                    
                            <?php 
                            $isAnyOffer=isAnyOffer($orderInfo[0]->business_id);
                            if(!empty($isAnyOffer) && ($totalServicePrice!=$orderInfo[0]->order_total)){ ?>
                    
                            <tr style="border-top: 1px solid #cecece;">
                                <td class="tblTD"><span class="common_data_left" style="color: #202023">Discount </span></td>
                                <td class="tblTD"><span class="common_data_right"><?php echo $isAnyOffer[0]->offer_title; ?></span></td>
                            </tr>
                            <tr style="border-top: 1px solid #cecece;">
                                <td class="tblTD"><span class="common_data_left" style="color: #202023">Total Price</span></td>
                                <td class="tblTD"><span class="common_data_right"><?php echo $totalServicePrice; ?> TK</span></td>
                            </tr>
                            <tr style="border-top: 1px solid #cecece;">
                                <td class="tblTD"><span class="common_data_left" style="color: #202023">Discount Price </span></td>
                                <td class="tblTD"><span class="common_data_right"><?php echo $orderInfo[0]->order_total; ?> TK</span></td>
                            </tr>
                            <tr>
                                <td class="tblTD"><span class="common_data_left" style="color: #202023">Payment</span></td>
                                <td class="tblTD"><span class="common_data_right"><?php echo ($orderInfo[0]->payment_method=='cod') ? 'Cash On Delivery' : 'Online'; ?></span></td>
                            </tr>
                            
                            <?php
                                }else{
                            ?>
                            
                            <tr style="border-top: 1px solid #cecece;">
                                <td class="tblTD"><span class="common_data_left" style="color: #202023">Total </span></td>
                                <td class="tblTD"><span class="common_data_right">
                                    <?php if($totalServicePrice!=$orderInfo[0]->order_total){echo '(Discount) ';} ?>
                                    <?php echo $orderInfo[0]->order_total; ?> TK</span></td>
                            </tr>
                            <tr>
                                <td class="tblTD"><span class="common_data_left" style="color: #202023">Payment</span></td>
                                <td class="tblTD"><span class="common_data_right"><?php echo ($orderInfo[0]->payment_method=='cod') ? 'Cash On Delivery' : 'Online'; ?></span></td>
                            </tr>
                            
                            <?php
                                
                                }
                            ?>
                    
                
                    
                    
                       </tbody>
                    </table>
                    <p style="color: #202023;font-size: 20px;font-family: font92726;text-align:left;">Booking Info</p>
                    
                    <table class="table ordersTable" style="background: #ffffff;">
                        <tbody>
                            
                            <tr>
                                <td class="tblTD"><span class="common_data_left">Booking Type</span></td>
                                <td class="tblTD"><span class="common_data_right"><?php echo ($orderInfo[0]->order_type==0) ? 'Now' : (($orderInfo[0]->order_type==1) ? 'Advanced' : 'Unknown'); ?></span></td>
                            </tr>
                
                            <tr>
                                <td class="tblTD"><span class="common_data_left">Booking Status</span></td>
                                <td class="tblTD">
                                    <span class="common_data_right">
                                        <?php if($orderInfo[0]->order_status==0){ ?>
                                            <span class="OrderDetailsPending">PENDING</span>
                                        <?php }elseif($orderInfo[0]->order_status==1){ ?>
                                            <span class="OrderDetailsAccepted">ACCEPTED</span>
                                        <?php }elseif($orderInfo[0]->order_status==2){ ?>
                                            <span class="OrderDetailsCancell">CANCELLED</span>
                                        <?php }else{ ?>
                                            <span class="Pstatus">Unknown</span>
                                        <?php } ?>
                                    </span>
                                </td>
                            </tr>
                            
                            <?php
                                if($orderInfo[0]->order_type==1){
                            ?>
                    
                            <tr>
                                <td class="tblTD"><span class="common_data_left" style="color: #202023">Service Time</span></td>
                                <td class="tblTD"><span class="common_data_right" style="color: #202023"><?php echo date( 'M d, Y h:i a',strtotime($orderInfo[0]->advance_order_date)); ?></span></td>
                            </tr>
                            
                            <?php
                                }
                                
                            ?>
                
                       </tbody>
                    </table>
                    
                    <?php if($orderInfo[0]->order_status==0){ ?>
                    <div class="ordersTable" style="background: #ffffff;min-height: 60px;width: 100%;">
                
                            <form action="<?php echo base_url(); ?>backoffice/order/updateOrder" method="POST" style="width: 50%;float: left;">
                                <input type="hidden" name="order_id" value="<?php echo $orderInfo[0]->order_id; ?>" />
                                <input type="hidden" id="order_status" name="order_status" value="2" required/>
                                <button id="submit_btn" type="submit" class="waves-effect waves-float" style="border: 1px solid #BBBBBB;border-radius: 20px;background: #FFFFFF;color: #717171;font-size: 14px;">CANCEL</button>
                            </form>
                
                            <form action="<?php echo base_url(); ?>backoffice/order/updateOrder" method="POST" style="width: 50%;float: left;">
                                <input type="hidden" name="order_id" value="<?php echo $orderInfo[0]->order_id; ?>" />
                                <input type="hidden" id="order_status" name="order_status" value="1" required/>
                                <button id="submit_btn" type="submit" class="waves-effect waves-float" style="border: 1px solid #BBBBBB;border-radius: 20px;background: #00B2E5;color: #FFFFFF;font-size: 14px;">ACCEPT</button>
                            </form>
                        
                    </div>
                    <?php } ?>
                </div>
            </div>
            
            <div class="col-md-7">
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
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>