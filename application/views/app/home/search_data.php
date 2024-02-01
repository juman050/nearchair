<?php
if(!empty($business_list)){?>
<ul class="list-group">
<?php
foreach($business_list as $business){ if($business->business_status=='1'){ ?>
    <a href="<?= site_url('app/business/'.$business->business_slug);?>" class="list-group-item ripplelink">
        <span class="fa fa-briefcase"></span> <?= $business->business_name;?>
    </a>              
<?php } }?>
</ul>
<?php }?>
<script>
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