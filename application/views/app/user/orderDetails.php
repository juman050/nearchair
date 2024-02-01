<div class="ordersTable" style="background: #ffffff;border-radius: 19px;padding: 15px 10px;">
    
    <a href="<?php echo base_url(); ?>app/business/<?php echo $userOrders[0]->business_slug; ?>" class="single-salon-box margin-toP ripplelink  "><p style="color: #202023;font-size: 20px;font-family: font92726;"><?php echo $userOrders[0]->business_name; ?></p></a>
    <p style="color: #717171;font-size: 16px;font-family: font92726;"><?php echo ($userOrders[0]->address!="") ? trim($userOrders[0]->address) : ''; ?></p>
    <p style="color: #202023;font-size: 18px;font-family: font92726;">Serial No : <?php echo $userOrders[0]->order_id; ?></p>
    
    <p style="color: #202023;font-size: 20px;font-family: font92726;text-align:left;">Sevices</p>
    <table class="table ordersTable" style="background: #ffffff;border-radius: 19px;padding: 15px 10px;">

    <tbody>
        
        <?php 
        
            if($userOrderServices){
                foreach($userOrderServices as $services){
        ?>

        <tr>
            <td class="tblTD" ><span class="common_data_left"><?php echo $services->service_name; ?></span></td>
            <td class="tblTD"><span class="common_data_right"><?php echo $services->service_price; ?> TK</span></td>
        </tr>
        
        <?php
                }
            }
        ?>

        <tr style="border-top: 1px solid #cecece;">
            <td class="tblTD"><span class="common_data_left" style="color: #202023;font-weight: 600;">Total </span></td>
            <td class="tblTD"><span class="common_data_right"><?php echo $userOrders[0]->order_total; ?> TK</span></td>
        </tr>
        <tr>
            <td class="tblTD"><span class="common_data_left" style="color: #202023;font-weight: 600;">Payment </span></td>
            <td class="tblTD"><span class="pull-right common_data_right"><?php echo ($userOrders[0]->payment_method=='cod') ? 'Cash On Delivery' : 'Online'; ?></span></td>
        </tr>


   </tbody>
    </table>
    

    <p style="color: #202023;font-size: 20px;font-family: font92726;text-align:left;">Booking info</p>

    <table class="table ordersTable" style="background: #ffffff;">
        <tbody>
            
            <tr>
                <td class="tblTD"><span class="common_data_left" style="color: #202023">Booking Type</span></td>
                <td class="tblTD"><span class="common_data_right"><?php echo ($userOrders[0]->order_type==0) ? 'Now' : (($userOrders[0]->order_type==1) ? 'Advanced' : 'Unknown'); ?></span></td>
            </tr>
            
            <?php
                if($userOrders[0]->order_type==1){
            ?>
    
            <tr>
                <td class="tblTD"><span class="common_data_left" style="color: #202023;font-weight: 600;">Service Time</span></td>
                <td class="tblTD"><span class="common_data_right"><?php echo date( 'M d, Y h:i a',strtotime($userOrders[0]->advance_order_date)); ?></span></td>
            </tr>
            
            <?php
                }
                
            ?>
    
            <tr>
                <td class="tblTD"><span class="common_data_left" style="color: #202023">Booking Status</span></td>
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
            
            <tr>
                <td class="tblTD"><span class="common_data_left" style="color: #202023">Date</span></td>
                <td class="tblTD">
                    <span class="common_data_right"><?php echo date( 'M d, Y h:i a',strtotime($userOrders[0]->order_date)); ?></span>
                </td>
            </tr>
            
       </tbody>
    </table>
    
    <?php if($userOrders[0]->order_status==1){ ?>
    <p style="color: #202023;font-size: 20px;font-family: font92726;text-align:left;">Review info</p>
    <table class="table ordersTable" style="background: #ffffff;">
    
        <tbody>
            <?php
                $is_reviewed = check_reviewed($userOrders[0]->order_id,$userOrders[0]->business_id,get_cookie('user_id'));
            ?>
            
            <?php if(empty($is_reviewed)): ?>
            <tr> 
                <td colspan="2" class="tblTD"> 
                <!-- Rating Stars Box -->
                    <div class='rating-stars' id="star_ratings_div" style="padding-top:15px;">
                    <select class='rating' id='rating'>
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                    </select>
                    <div style='clear: both;'></div>
                
                    <input type="hidden" id="rating_value" value="1">
                    <input type="hidden" id="order_id" value="<?php echo $userOrders[0]->order_id; ?>">
                    <input type="hidden" id="business_id" value="<?php echo $userOrders[0]->business_id; ?>">
                    <input type="hidden" id="user_id" value="<?php echo get_cookie('user_id'); ?>">
                    <textarea class="form-control review_text" placeholder="Your feedback..." id="review_text" rows="3"></textarea>
                    <span class="text_required" style="display:none;color:#ff546f">Feedback field is required.</span>
                    <button class="btn btn-warning pull-right ripplelink" id="submit_review">Post</button>
                
                </div>
                </td>
            </tr>
            <?php else: ?>
            <tr>
                <td class="tblTD"><span class="common_data_left">Rating Point</span></td>
                <td class="tblTD">
                    <span class="common_data_right">
                        <?php for($i=1;$i<=$is_reviewed[0]->rating;$i++){ ?> <i class="fa fa-star" style="color: #ffa500;font-size: 14px;"></i> <?php } ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="tblTD"><span class="common_data_left">Your Comment</span></td>
                <td class="tblTD">
                    <span class="common_data_right"><?php echo $is_reviewed[0]->review_text; ?></span>
                </td>
            </tr>
            <?php endif; ?>
    
            
       </tbody>
    </table>
    <?php } ?>
</div>





<script src="<?php echo site_url();?>resource/app/js/jquery.barrating.min.js" type="text/javascript"></script>
<script>
    /*
    * This function is write reviews
    * @author:juman 
    * @date:11/09/2019 
    */
    $(document).ready(function(){
        $('#rating').barrating('set',1);
    });
    $(function() {
        $('#rating').barrating({
          theme: 'fontawesome-stars',
          onSelect: function(value, text, event) {
               // Get rating value
               $("#rating_value").val(value);
          }
        });
    });
    $(document).ready(function(){
        $("button#submit_review").on("click", function(){
         var business_id = $("#business_id").val(); // business_id
         var user_id = $("#user_id").val(); // user_id
         var order_id = $("#order_id").val(); // order_id
         var review_text = $("#review_text").val();
         var rating = $("#rating_value").val();
         if(review_text !== null && review_text !== '') {
            $("#review_text").css("border", "none");
            $(".text_required").css("display","none");
           // AJAX Request
             $.ajax({
               url: '<?php echo site_url("app/addreview");?>',
               type: 'post',
               data: {business_id:business_id,user_id:user_id,order_id:order_id,rating:rating,review_text:review_text},
               dataType: 'json',
               success: function(response){
                   
                  $('#success_tic').modal('show');
                  $('#modalDetails').modal('hide');
                  $('#success_tic').find('.head-text').text(response.msg);
               }
             });
         }else{
             $("#review_text").css("border", "1px solid #ff546f");
             $(".text_required").css("display","block");
         }
        });
    });
</script>
