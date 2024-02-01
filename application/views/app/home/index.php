
       <header>
            <div class="header-slider owl-carousel">
                <?php
                if(!empty($sliders)){
                foreach($sliders as $slider){
                ?>
                <div class="item slider-img lazy" data-src="<?php echo site_url("drives/slider/".$slider->slider_img);?>" >
                    <div class="overlay">
                        <div class="container">
                            <div class="row">  
                            </div>
                        </div>
                    </div>
                </div>
                <?php } }else{ ?>
                    <div class="alert alert-danger">Data not found.</div>
                <?php }?>
            </div> 
        </header>
        <section class="home-page-gategory-section">
            <div class="container padding-lf-zero">
                <div class="tabmenu-wrapper-div">
                <!--<div class="row">-->
                <!--    <div class="col-md-12">-->
                <!--        <div class="section-heading">-->
                <!--            <h2 class="sec-title">Services</h2>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <?php
                    $men = get_cookie('men');
                	$women = get_cookie('women');
                	$tab1_active='';
                	$tab2_active='';
                	if(isset($women)){
                	    $tab2_active='active';
                	}else{
                	    $tab1_active='active';
                	}
                ?>
                <ul class="nav nav-tabs custom-nav-tabs " role="tablist" id="swipe-nav">
                    <li role="presentation" class="<?=$tab1_active;?> custom-navtab-item "><a href="#Men" aria-controls="men" role="tab" data-toggle="tab" class="men">Men</a></li>
                    <li role="presentation" class="<?=$tab2_active;?> custom-navtab-item "><a href="#Women" aria-controls="women" role="tab" data-toggle="tab" class="women">Women</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content custom-tab-content">
                    <div role="tabpanel" class="tab-pane custom-tab-panel <?=$tab1_active;?>" id="Men">
                        <div class="panel-wrapper">
                            <div class="panel-group wrap custom-panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel custom-panel">
                                <div class="row">                    
                                        <ul class="category-grid">
                                            <?php
                                            if(!empty($categories)){
                                            foreach($categories as $cat){
                                            ?>
                                            <li class="gat-item">
                                                <div class="singel-category men">
                                                    
                                                    <div class="box-thumbnail ripplelink">
                                                        <a href="<?php echo base_url('app/category/'.$cat->category_id); ?>" class="category-img bg-img ">
                                                            <img class="lazy" data-src="<?php echo site_url() ?>/drives/category/<?php echo $cat->category_img;?>" alt="">                                        
                                                        </a>
                                                       
                                                        <h3 class="heading-3 men">
                                                            <a href="<?php echo base_url('app/category/'.$cat->category_id); ?>" ><?php echo $cat->category_name;?> </a>
                                                        </h3> 
                                                    </div> 
                                                    <div class="gradient-overlay"></div>
                                                    
                                                </div>
                                                
                                            </li>
                                            <?php }  }else{ ?>
                                                <div class="alert alert-danger">Data not found.</div>
                                            <?php }?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane custom-tab-panel <?=$tab2_active;?>" id="Women">
                        <div class="panel-wrapper">
                            <div class="panel-group wrap custom-panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel custom-panel">
                                    <div class="row">                    
                                        <ul class="category-grid">
                                            <?php
                                            if(!empty($categories2)){
                                            foreach($categories2 as $cat){
                                            ?>
                                            <li class="gat-item">
                                                <div class="singel-category women">
                                                    
                                                    <div class="box-thumbnail ripplelink">
                                                        <a href="<?php echo base_url('app/category/'.$cat->category_id); ?>" class="category-img bg-img ">
                                                            <img class="lazy" data-src="<?php echo site_url() ?>/drives/category/<?php echo $cat->category_img;?>" alt="">                                        
                                                        </a>
                                                       
                                                        <h3 class="heading-3 women">
                                                            <a href="<?php echo base_url('app/category/'.$cat->category_id); ?>" ><?php echo $cat->category_name;?> </a>
                                                        </h3> 
                                                    </div> 
                                                    
                                                </div>
                                                
                                            </li>
                                            <?php }  }else{ ?>
                                                <div class="alert alert-danger">Data not found.</div>
                                            <?php }?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
               
  
               </div>
            </div>
        </section>
    <script src="<?= site_url('resource/app/js/');?>swiped-events.js"></script>
    
    <script>

        window.onload = function() {

            $("#Men").on('swiped-left', function(e) {
                $('.nav-tabs a[href="#Women"]').tab('show');
                //e.target.innerHTML = e.type;
            });
            
            $("#Women").on('swiped-right', function(e) {
                $('.nav-tabs a[href="#Men"]').tab('show');
                //e.target.innerHTML = e.type;
            });
            
            

            document.addEventListener('swiped-up', function(e) {
                //console.log(e.type);
                //console.log(e.target);
                //e.target.innerHTML = e.type;
            });

            document.addEventListener('swiped-down', function(e) {
                //console.log(e.type);
                //console.log(e.target);
                //e.target.innerHTML = e.type;
            });

        }
    
    </script>
