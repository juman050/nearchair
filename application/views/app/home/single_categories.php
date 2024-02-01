<?php
delete_cookie("men");
delete_cookie("women");
if($category_data->category_type==1){
    $expire_time=time() +2592000;
    set_cookie('men',1,$expire_time);
}else{
    $expire_time=time() +2592000;
    set_cookie('women',2,$expire_time);
}

?>
        <div class="gategory-page-header" >
            <div class="container">
                <div class="row single-category-bg " style="background-image: url(<?php echo site_url() ?>/drives/category/<?php echo $category_data->category_img;?>);">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- <div class="header-img">
                             <img src="images/images3.png" alt="">
                        </div> -->  
                       
                        <div class="containt">
                            <!--<h2 class="heading-text"><?php  echo $category_data->category_name; ?></h2>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="category-single-page-list">
            <div class="container">
                <?php  if(!empty($category_services)){?>
                <div class="row" style="background: #fff;border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="top-bar">
                            <h5 class="gate-title"><a href="" class="ripplelink"><?php  echo $category_data->category_name; ?></a></h5>
                            <!--<span class="view-btn"><a href="">View all</a></span>-->
                        </div>
                            
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 remove-left-padding">
                        <div class="single-gat-item-name">
                            <ul class="list-unstyled">
                                <?php
                                foreach($category_services as $services){
                                ?>
                                <li class="list-item-neme ripplelink">
                                    <a href="<?php echo site_url('app/goto_business/'.$services->service_id); ?>" ><?=$services->service_name;?></a>
                                </li>
                                <?php } ?>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } else{ ?>
                    <div class="alert alert-danger">Data not found.</div>
                <?php }?>
            </div>
        </section>

<script>
    $(document).ready(function() {
       
       var city_id = Number($("#nc_city_id").val());
	   var area_id = Number($("#nc_area_id").val());
	   if(!city_id && !area_id){
	      setTimeout( function(){ $('#pickLocation').modal('show'); } , 500 );
	   }
	  
    });
    
</script>