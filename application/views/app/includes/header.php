<!DOCTYPE html>
<html lang="en">
<head>
    <!--=== meta ===-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel='shortcut icon' type='image/x-icon' href='<?php echo base_url(); ?>favicon.ico' />
    <title><?php echo $pageTitle; ?></title>

    <!--=== css fixed ===-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/bootstrap.min.css"> <!-- Bootstrap v3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/font-awesome.min.css"> <!-- Font Awesome V4.7.0 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/owl.carousel.css"> <!-- owl.carousel.css V2.7.0 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/jquery-ui.css">

    <!--=== custom css ===-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/app/css/custom.css">


    <script src="<?php echo base_url(); ?>resource/app/js/jquery.min.js"></script> <!-- jQuery v3.1.1 -->
    <!-- cdnjs -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
                
    <script src="<?php echo base_url(); ?>resource/app/js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>resource/app/js/jquery-ui.js"></script>
    <script src="<?php echo base_url(); ?>resource/app/js/loadingoverlay.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
        var siteURL = "<?php echo site_url(); ?>";
    </script>
</head>
<body>
      <div class="page-wrapper">
<?php 
$app_logo = system_info()->nearchair_app_logo;
?>  
    <?php if($pageName=="Home" || $pageName=="Profile"): ?>
      <nav class="navbar navbar-default app-navbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-2 col-md-7 top-block">
                        <button type="button" class="navbar-toggle x-icon collapsed ripplelink" id="nc-drawer" aria-expanded="false">
                            <!-- <span class="sr-only">Toggle navigation</span> -->
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="col-xs-6 col-md-7 top-block">
                        <div class="app-logo-div" style="">
                            <span class="app-logo-text">NearChair</span>
                        </div>
                    </div>
                    <div class="col-xs-4 col-md-3 top-block">
                        <div class="top_icon_wrap">
                            <span class="location_icon ripplelink" >
                                <img width="20px" src="<?php echo site_url('resource/icons/map-pin-white.svg')?>"/>
                                <!--<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>-->
                            </span>
                            <span class="search-icon ripplelink" >
                                <img width="20px" src="<?php echo site_url('resource/icons/search.svg')?>"/>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
              
            
            
            
            <!-- Collect the nav links, forms, and other content for toggling -->
                  
                <div class="collapse navbar-collapse app-navbar-collapse" id="main-navigation">
                    <ul class="nav navbar-nav navbar-right app-navbar-nav">
                        <li class=" "><a href="<?php echo base_url('app/home'); ?>" class='ripplelink'><span class="control-icon-margin"><i class="glyphicon glyphicon-home" aria-hidden="true"></i></span>Home</a></li>

                        <?php if(get_cookie('isUserLoggedIn') != TRUE): ?>
                        <li><a href="<?php echo base_url('app/user'); ?>" class='ripplelink'><span class="control-icon-margin"><i class="fa fa-user" aria-hidden="true"></i></span>Profile</a></li>
                        <?php else: ?>
                        <li ><a href="<?php echo base_url('app/userprofile'); ?>" class='ripplelink'><span class="control-icon-margin"><i class="fa fa-user" aria-hidden="true"></i></span>Profile</a></li>
                        
                        <?php endif; ?>
                        
                        <!--<li><a href="<?php echo base_url('app/instructions'); ?>" class='ripplelink'><span class="control-icon-margin"><i class="fa fa-lightbulb-o" aria-hidden="true"></i></span>Instructions</a></li>-->
                        <li><a href="<?php echo base_url('app/about'); ?>" class='ripplelink'><span class="control-icon-margin"><i class="fa fa-question-circle" aria-hidden="true"></i></span>About</a></li>
                        <li><a href="<?php echo base_url('app/contact'); ?>" class='ripplelink'><span class="control-icon-margin"><i class="fa fa-phone" aria-hidden="true"></i></span>Contact</a></li>
                        
                        <?php if(get_cookie('isUserLoggedIn') == TRUE): ?>
                        <hr class="hav-hr">
                        <li><a href="<?php echo base_url('app/logoutUser'); ?>" class='ripplelink' style="color: #000;"><span class="control-icon-margin"><i class="fa fa-sign-out" aria-hidden="true"></i></span>Log out</a></li>
                        <?php endif; ?>
                        <!--<li><a href="mailto:<?=$system_data->nearchair_email?>" class='ripplelink'><span class="control-icon-margin"><i class="fa fa-send" aria-hidden="true"></i></span>Send Email</a></li>-->
                    </ul>
                </div><!-- /.navbar-collapse -->
        </nav> 
    <?php else: ?>
        <nav class="navbar navbar-default app-navbar inner-page-app-nav">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-2 top-block">
                        <span class="back-icon ripplelink">
                            <?php
                                if($pageName=='business' || $pageName=='Profile'){ $goback=site_url('app/home/'); }else{ $goback="javascript:history.back();"; }
                            ?>
                           <a href="<?=$goback;?>" ><img width="21px" src="<?php echo site_url('resource/icons/arrow-left.svg');?>"/></a> 
                        </span>
                    </div>
                    <div class="col-xs-6 top-block">
                        <div class="app-logo-div"  style="">
                            <?php if($pageName=='Home' || $pageName=='Profile'): ?>
                            <span class="app-logo-text">NearChair</span>
                            <?php else: ?>
                            <?php //$finaltext = strlen($pageTitle) > 20 ? substr($pageTitle,0,20)."..." : $pageTitle;?>
                            <span class="app-pageTitle-text"><?=$pageTitle;?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xs-4 top-block">
                        <div class="top_icon_wrap">
                            <span class="location_icon ripplelink" >
                                <img width="20px" src="<?php echo site_url('resource/icons/map-pin-white.svg')?>"/>
                                <!--<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>-->
                            </span>
                            <span class="search-icon ripplelink" >
                                <img width="20px" src="<?php echo site_url('resource/icons/search.svg')?>"/>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
                
        </nav>
    <?php endif; ?>
    
   