
    <!-- Bottom Nav -->
        <div class="bottom-btn-wrapper" id="bottom-nav-controll">
            <div class="botton-btn ">
                <a href="<?php echo base_url('app/home'); ?>" class="home-btn ripplelink">
                    <?php if($pageName=='Home'){ $hs = 'service-fill.svg'; }else{ $hs = 'services.svg'; };?>
                   
                    <img height="22px" src="<?php echo site_url('resource/icons/'.$hs);?>"/>
                   <span class='bottom-icon-text <?php if($pageName=='Home'){ echo 'active'; };?>'>Services</span>
                </a>
            </div>
            
            <div class="botton-btn">
                <a href="<?php echo site_url('app/homeservice');?>" class="user-btn ripplelink">
                    <?php if($pageName=='home_service'){ $hs = 'home-fill.svg'; }else{ $hs = 'home.svg'; };?>
                    <img height="22px" src="<?php echo site_url('resource/icons/'.$hs);?>"/>
                    <span class='bottom-icon-text <?php if($pageName=='home_service'){ echo 'active'; };?>'>Home service</span>
                </a>
            </div>
            
            
            <div class="botton-btn ">
                
                <a href="tel:<?=$system_data->nearchair_mobile?>" class="cart-btn ripplelink " id="call_us_btn">
                   <img width="22px" src="<?php echo site_url('resource/icons/support.svg');?>"/>
                   <span class='bottom-icon-text'>Support</span>
                </a>
            </div>
            <div class="botton-btn ">
                <?php $count = count($this->cart->contents());
                if (!$count) { ?>
                <a href="<?php echo base_url('app/user'); ?>" class="user-btn ripplelink">
                    <?php if($pageName=='Profile' || $pageName=='LogIn' || $pageName=='Register'){ $hs = 'profile-fill.svg'; }else{ $hs = 'profile.svg'; };?>
                    <img height="22px" src="<?php echo site_url('resource/icons/'.$hs);?>"/>
                    <span class='bottom-icon-text <?php if($pageName=='Profile' || $pageName=='LogIn' || $pageName=='Register'){ echo 'active'; };?>'>Profile</span>
                </a>
                <?php }else{?>
                <?php 
                    if(get_cookie('isUserLoggedIn') == TRUE){
                        $url = site_url('app/checkout');
                    }else{
                        $url = site_url('app/user');
                    }
                ?>
                <a href="<?php echo $url; ?>" class="cart-btn ripplelink " id="cart_btn">
                   <i class="fa fa-calendar <?php if($pageName=='checkout'){ echo 'active'; };?>"></i><span class="cart-item"><?=$count;?></span>
                   <span class='bottom-icon-text <?php if($pageName=='checkout'){ echo 'active'; };?>'>Appointment</span>
                </a> 
                <?php } ?>
            </div>
            
        </div>

    </div>
    

    
    
    
    
    
    
	
	<!-- search overlay -->
	<div class="modal" id="pickSearch" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-full" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="input-group top-search">
                        <span class="clearable">
                    	    <input id="mobileSearchBar" type="text" autofocus placeholder="Find service, salon, parlour..." autocomplete="off" class="input is-large">
                    	    <img width="21px" class="image-back-btn" src="<?= site_url('resource/app/icon/left-arrow-blk.png');?>" data-dismiss="modal" />
                    		<!--<i class="fa fa-angle-left ripplelink" ></i>-->
                    		<img class="search-loading" src="<?php echo site_url('resource/app/icon/loadingImage.gif');?>">
                    		<span class="clearable-clear clear-icon" style="display: none;">x</span>
                    	</span>
                    </div>
				</div>
				<div class="modal-body" id="search-result">
				</div>
				<div class="modal-footer">
				    <ul class="list-group" id="cat_services">
				    
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	
	<!-- search overlay -->
	<div class="modal" id="pickLocation" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-full" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<div class="input-group top-search">
                        <span class="clearable">
                    	    <input id="locationSearchBar" type="text" autofocus placeholder="Find Your Location..." autocomplete="off" class="input is-large">
                    	    <img width="21px" class="image-back-btn" src="<?= site_url('resource/app/icon/left-arrow-blk.png');?>" data-dismiss="modal" />
                    		<!--<i class="fa fa-angle-left ripplelink" ></i>-->
                    		<img class="search-loading" src="<?php echo site_url('resource/app/icon/loadingImage.gif');?>">
                    		<span class="clearable-clear clear-icon" style="display: none;">x</span>
                    	</span>
                    </div>
				</div>
				<div class="modal-body">
				    <?php 
                	 $city_id="";
                     $area_id="";
                	 if(get_cookie('city')!==null){ $city_id = get_cookie('city'); }
                	 if(get_cookie('area')!==null){$area_id = get_cookie('area');}
                	 ?>
                	<input type="hidden" id="nc_city_id" value="<?php echo isset($city_id)? $city_id :'' ?>" />
                	<input type="hidden" id="nc_area_id" value="<?php echo isset($area_id)? $area_id :'' ?>" />
				    <ul class="list-group" id="AreaUnderCity">
				        <?php $areas =  getAreaUnderCity(1);
                            if (!empty($areas)){
                                foreach($areas as $ar){ ?>
                                 <a href="<?php echo site_url('app/setAreaData/area/'.$ar->area_id); ?>" class="list-group-item ripplelink"><span class="glyphicon glyphicon-map-marker"></span> <?=$ar->area_name;?></a>
                                <?php 
                                    
                                }
                            }
                        ?>
					 </ul>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<!-- nav drawer change bg -->
	<div class="nc-drawer-bg" style="height: 731px;"></div>
	
    
    
    <!--=== fixed js ===-->
    <script type="text/javascript" src="<?php echo base_url(); ?>resource/app/js/bootstrap.min.js"></script> <!-- Bootstrap v3.3.7 -->

    <!--=== custom js ===-->
    <script type="text/javascript" src="<?php echo base_url(); ?>resource/app/js/owl.carousel.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>resource/app/js/custom.js"></script>
    
    
    <script type="text/javascript">
        $(function() {
            $('.lazy').lazy();
        });
        
		$(document).ready(function() {
		   //getSylhetArea();
		   $("#set_location_btn").on('click', function (e){
		        //var city_id = $('#city_id').val();
		        var city_id = Number(1);
		        var area_id = $('#area_id').val();
		         if( !city_id && !area_id) { 
		              $(".group-area select").css("border","1px solid #fd5a5a");
		         }else{
		             setCookieData(city_id,area_id)
		         }
		   });
		   
		   /** open close search overlay**/
		   $(".search-icon").on('click', function (e){
		          setTimeout( function(){ 
		              $('#pickSearch').modal('show'); 
		              $.ajax({
                		type: "POST",
                		url: "<?php echo site_url('app/getAllCategories');?>",
                		dataType : 'html',
                        cache: false,
                		success: function(html){
                		   $("#cat_services").html(html);
                		}
            		  });
		          } , 300 );
		          $("input#mobileSearchBar").focus();
		   });
		   $(".location_icon").on('click', function (e){
		          $("input#locationSearchBar").focus();
		          setTimeout( function(){ $('#pickLocation').modal('show'); } , 300 );
		   });
		   $("#changeLocation").on('click', function (e){
		          $("input#locationSearchBar").focus();
		          setTimeout( function(){ $('#pickLocation').modal('show'); } , 300 );
		   });
		   $(".clear-icon").on('click', function (e){
		      $('.clear-icon').css('display','none');
		      $("input#mobileSearchBar").val("");
		      $("input#locationSearchBar").val("");
		      $("#servicessUnderCat a").show();
		      $(".cat_name").show();
		      $("input#mobileSearchBar").focus();
		   });
		    /*
            * This function is used to find busnesses
            * @author:juman 
            * @date:14/09/2019 
            */
           var timer;
		   $("#mobileSearchBar").keyup(function(){
		        
		        var search_text = $(this).val();
		        $('.clear-icon').css('display','none');
		        clearTimeout(timer) // clear the request from the previous event
                timer = setTimeout(function(){
		            
    		        if(search_text.length>0){
                		$.ajax({
                		type: "POST",
                		url: "<?php echo site_url('app/searchBusiness');?>",
                		data:'keyword='+search_text,
                		beforeSend: function(){
                			$(".search-loading").css("display","block");
                		},
                		success: function(data){
                		    filterService(search_text);
                		    $(".search-loading").css("display","none");
                		    $('.clear-icon').css('display','block');
                			$("#search-result").show();
                			$("#search-result").html(data);
                		}
                		});
    		        }else{
    		            $("#servicessUnderCat a").show();
    		            $(".cat_name").show();
    		        }
		        }, 300);
		        
        	});
        	
        	var timer;
		   $("#locationSearchBar").keyup(function(){
		        
		        var search_text = $(this).val();
		        $('.clear-icon').css('display','none');
		        $(".search-loading").css("display","block");
		        clearTimeout(timer) // clear the request from the previous event
                timer = setTimeout(function(){
		            
    		        if(search_text.length>0){
                		filterArea(search_text);
            		    $(".search-loading").css("display","none");
            		    $('.clear-icon').css('display','block');
    		        }else{
    		            $(".search-loading").css("display","none");
    		            $("#AreaUnderCity a").show();
    		        }
		        }, 300);
		        
        	});
		});
		function setCookieData(city_id,area_id) {
        	$.ajax({
            	type: "POST",
            	url: '<?php echo site_url("app/setCookieData");?>',
            	data:{city_id:city_id,area_id:area_id},
            	dataType : 'JSON',
                cache: false,
            	
            	success: function(data){
            	    if(data.isValid == "true"){
            	        $(".group-area select").css("border","1px solid #eee");
            	        window.location.href = '<?php echo base_url("app/nearestBusiness");?>';
            	    }else{
            	        console.log("invalid location");
            	    }
            		
            	}
        	});
        }
		function filterService(element) {
            var value = element.toUpperCase();
    
            $("#servicessUnderCat a").each(function() {
                
                if ($(this).text().toUpperCase().search(value) > -1) {
                    $(".cat_name").hide();
                    $(this).show();
                }
                else {
                    $(".cat_name").hide();
                    $(this).hide();
                }
            });
        }
        function filterArea(element) {
            var value = element.toUpperCase();
    
            $("#AreaUnderCity a").each(function() {
                
                if ($(this).text().toUpperCase().search(value) > -1) {
                    $(this).show();
                }
                else {
                    $(this).hide();
                }
            });
        }
        function getArea(val) {
        	$.ajax({
        	type: "POST",
        	url: '<?php echo site_url("app/getAreaUnderCity");?>',
        	data:'city_id='+val,
        	success: function(data){
        		$(".area_picker").css("display","block");
        		$(".area_picker").html(data);
        	}
        	});
        }
        function getSylhetArea() {
        	$.ajax({
        	type: "POST",
        	url: '<?php echo site_url("app/getAreaUnderCity");?>',
        	data:'city_id=1',
        	success: function(data){
        		$(".area_picker").css("display","block");
        		$(".area_picker").html(data);
        	}
        	});
        }
        
	</script>
	
    <script type="text/javascript">
    
        $(document).ready(function() {
            $("#nc-drawer").on('click', function (e){
              var menu_opened = $('#main-navigation').hasClass('in');
              if( menu_opened === true){
                  $('#main-navigation').collapse('toggle');
		          $(".nc-drawer-bg").removeClass("active");
              }else{
                $('#main-navigation').collapse('toggle');
		        $(".nc-drawer-bg").addClass("active");
              }
		      
		   });
            
        });
        /** CLOSE MAIN NAVIGATION WHEN CLICKING OUTSIDE THE MAIN NAVIGATION AREA**/
        $(document).on('click', function (e){
            /* bootstrap collapse js adds "in" class to your collapsible element*/
            var menu_opened = $('#main-navigation').hasClass('in');
          
            if(!$(e.target).closest('#main-navigation').length && !$(e.target).is('#main-navigation') && menu_opened === true){
                $('#main-navigation').collapse('toggle');
                $(".nc-drawer-bg").removeClass("active");
                 return false;
            }
        
        });
        //jQuery time
        var parent, ink, d, x, y;
        $(".ripplelink").click(function(e){
        	parent = $(this);
        	//create .ink element if it doesn't exist
        	if(parent.find(".ink").length == 0)
        		parent.prepend("<span class='ink'></span>");
        		
        	ink = parent.find(".ink");
        	//incase of quick double clicks stop the previous animation
        	ink.removeClass("animate");
        	
        	//set size of .ink
        	if(!ink.height() && !ink.width())
        	{
        		//use parent's width or height whichever is larger for the diameter to make a circle which can cover the entire element.
        		d = Math.max(parent.outerWidth(), parent.outerHeight());
        		ink.css({height: d, width: d});
        	}
        	
        	//get click coordinates
        	//logic = click coordinates relative to page - parent's position relative to page - half of self height/width to make it controllable from the center;
        	x = e.pageX - parent.offset().left - ink.width()/2;
        	y = e.pageY - parent.offset().top - ink.height()/2;
        	
        	//set the position and add class .animate
        	ink.css({top: y+'px', left: x+'px'}).addClass("animate");
        })
    </script>
    
</body>
</html>