<link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/login.css">
<div class="ordersTable" style="background: #ffffff;border-radius: 19px;padding: 15px 10px;height:auto;">

    <p style="color: #202023;font-size: 20px;font-family: font92726;"><?php echo $userOrders[0]->fullname; ?></p>
    <p style="color: #717171;font-size: 16px;font-family: font92726;"><?php echo ($userOrders[0]->user_address!="") ? $userOrders[0]->user_address : ''; ?></p>
    <p style="color: #717171;font-size: 16px;"><?php echo date( 'M d, Y h:i a',strtotime($userOrders[0]->order_date)); ?></p>
    <p style="color: #202023;font-size: 18px;font-family: font92726;">Serial No : <?php echo $userOrders[0]->order_id; ?></p>
    

    <p style="color: #202023;font-size: 20px;font-family: font92726;text-align:left;">Service Info</p>
    
    <table class="table ordersTable" style="background: #ffffff;">

        <tbody>
    
            <?php 
            
                $totalServicePrice = 0;
                if($userOrderServices){
                    foreach($userOrderServices as $services){
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

                if(!empty($isAnyOffer) && ($totalServicePrice!=$userOrders[0]->order_total)){
            ?>
    
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
                <td class="tblTD"><span class="common_data_right"><?php echo $userOrders[0]->order_total; ?> TK</span></td>
            </tr>
            <tr>
                <td class="tblTD"><span class="common_data_left" style="color: #202023">Payment</span></td>
                <td class="tblTD"><span class="pull-right common_data_right"><?php echo ($userOrders[0]->payment_method=='cod') ? 'Cash On Delivery' : 'Online'; ?></span></td>
            </tr>
            
            <?php
                }else{
            ?>
            
            <tr style="border-top: 1px solid #cecece;">
                <td class="tblTD"><span class="common_data_left" style="color: #202023">Total </span></td>
                <td class="tblTD"><span class="common_data_right">
                    <?php if($totalServicePrice!=$userOrders[0]->order_total){echo '(Discount) ';} ?>
                    <?php echo $userOrders[0]->order_total; ?> TK</span></td>
            </tr>
            <tr>
                <td class="tblTD"><span class="common_data_left" style="color: #202023">Payment</span></td>
                <td class="tblTD"><span class="pull-right common_data_right"><?php echo ($userOrders[0]->payment_method=='cod') ? 'Cash On Delivery' : 'Online'; ?></span></td>
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
                <td class="tblTD"><span class="common_data_right"><?php echo ($userOrders[0]->order_type==0) ? 'Now' : (($userOrders[0]->order_type==1) ? 'Advanced' : 'Unknown'); ?></span></td>
            </tr>

            <tr>
                <td class="tblTD"><span class="common_data_left">Booking Status</span></td>
                <td class="tblTD">
                    <span class="common_data_right">
                        <?php if($userOrders[0]->order_status==0){ ?>
                            <span class="pull-right OrderDetailsPending">PENDING</span>
                        <?php }elseif($userOrders[0]->order_status==1){ ?>
                            <span class="pull-right OrderDetailsAccepted">ACCEPTED</span>
                        <?php }elseif($userOrders[0]->order_status==2){ ?>
                            <span class="pull-right OrderDetailsCancell">CANCELLED</span>
                        <?php }else{ ?>
                            <span class="pull-right Pstatus">Unknown</span>
                        <?php } ?>
                    </span>
                </td>
            </tr>
            
            <?php
                if($userOrders[0]->order_type==1){
            ?>
    
            <tr>
                <td class="tblTD"><span class="common_data_left" style="color: #202023">Service Time</span></td>
                <td class="tblTD"><span class="common_data_right" style="color: #202023"><?php echo date( 'M d, Y h:i a',strtotime($userOrders[0]->advance_order_date)); ?></span></td>
            </tr>
            
            <?php
                }
                
            ?>

       </tbody>
    </table>
    
    <?php if($userOrders[0]->order_status==0){ ?>
    <div class="ordersTable" style="background: #ffffff;min-height: 60px;width: 100%;">

            <form action="<?php echo base_url(); ?>app/changeOrderStatus" method="POST" style="width: 50%;float: left;">
                <input type="hidden" name="order_id" value="<?php echo $userOrders[0]->order_id; ?>" />
                <input type="hidden" id="or_status" name="or_status" value="2" required/>
                <button id="submit_btn" type="submit" class="waves-effect waves-float" style="border: 1px solid #BBBBBB;border-radius: 20px;background: #FFFFFF;color: #717171;font-size: 14px;">CANCEL</button>
            </form>

            <form action="<?php echo base_url(); ?>app/changeOrderStatus" method="POST" style="width: 50%;float: left;">
                <input type="hidden" name="order_id" value="<?php echo $userOrders[0]->order_id; ?>" />
                <input type="hidden" id="or_status" name="or_status" value="1" required/>
                <button id="submit_btn" type="submit" class="waves-effect waves-float" style="border: 1px solid #BBBBBB;border-radius: 20px;background: #00B2E5;color: #FFFFFF;font-size: 14px;">ACCEPT</button>
            </form>
        
    </div>
    <?php } ?>
</div>

