<!DOCTYPE html>
<html lang="en">
<head>
    <!--=== meta ===-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pageTitle; ?></title>

    <!--=== css fixed ===-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/owner/css/bootstrap.min.css"> <!-- Bootstrap v3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/owner/css/font-awesome.min.css"> <!-- Font Awesome V4.7.0 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/owner/css/jquery-ui.css">

    <!--=== custom css ===-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/owner/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/owner/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>resource/owner/wave/dist/waves.min.css"> <!-- waves -->
    
    <script src="<?php echo base_url(); ?>resource/owner/js/jquery.min.js"></script> <!-- jQuery v3.1.1 -->
    <script src="<?php echo base_url(); ?>resource/owner/js/loadingoverlay.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>resource/owner/wave/dist/waves.min.js"></script>
    <script type="text/javascript">
        window.onload=function(){
            Waves.init();

            Waves.attach('.flat-box', ['waves-block']);
            Waves.attach('.float-box', ['waves-block', 'waves-float']);
            Waves.attach('.waves-image');
        }
        var baseURL = "<?php echo base_url(); ?>";
        var siteURL = "<?php echo site_url(); ?>";
    </script>
</head>
<body style="background:url('<?php echo base_url() ?>resource/app/icon/bg.png');">
   <div class="page-wrapper">
        <?php if($pageName!="Login"){ ?>
        <!--++++++++++ header ++++++++++-->
        <header>
            <!--  add dark nav  -->
            <nav class="nav" style="background-image: linear-gradient(to right, #fc6ba6 , #09b1e3);">
                <div class="container">
                    <div class="nav-heading">
                        <div class="col-xs-9 waves-effect no_padding">
                            
                                <?php if($pageName == "Profile"){ ?>
                                <p class="header_p_logo">Nearchair</p>
                                <? }else{ ?>
                                <div class="img-box" style="float: left;">
                                    <a href="<?php echo base_url().'app/profile' ?>"><img  class="waves-image" height="26px"  src="<?php echo base_url(); ?>resource/app/icon/left-back.png"></a>
                                </div>
                                <p class="header_p" style="color:#ffffff;"><?php echo $pageName; ?></p>
                                <? } ?>
                            
                        </div>
                        
                        <?php if($pageName == "Profile"){ ?>
                            <div class="col-xs-3" style="padding-right: 5px;">
                                <button class="toggle-nav logout_icon" ><i class="fa fa-power-off float-icon waves-effect waves-circle" style="background: #000000;color: #ffffff;"></i></i></button>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="menu" id="open-navbar1">
                        <ul class="list">
                            <li><a href="javascript:void(0);" class="logout_icon">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <?php } ?>

