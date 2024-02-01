<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>resource/backoffice/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>resource/backoffice/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo base_url(); ?>resource/backoffice/assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>resource/backoffice/assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>resource/backoffice/assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
    </style>
    <script src="<?php echo base_url(); ?>resource/backoffice/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.0.0.min.js"></script>
    <script src="<?php echo base_url(); ?>resource/backoffice/assets/bower_components/jquery-ui/jquery-ui.js" type="text/javascript"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
        var siteURL = "<?php echo site_url(); ?>";
    </script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition skin-green-light sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>NearChair</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>NearChair</b> </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-history"></i>
                </a>
                <ul class="dropdown-menu">
                  <li class="header"> Last Login : <i class="fa fa-clock-o"></i> <?= empty($last_login) ? "First Time Login" : $last_login; ?></li>
                </ul>
              </li>
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>resource/backoffice/assets/dist/img/avatar.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <img src="<?php echo base_url(); ?>resource/backoffice/assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $name; ?>
                      <small><?php echo $role_text; ?></small>
                    </p>
                    
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo site_url(); ?>backoffice/profile" class="btn btn-warning btn-flat"><i class="fa fa-user-circle"></i> Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo site_url(); ?>backoffice/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li>
              <a href="<?php echo base_url(); ?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
            </li>
            
            <?php
            if($role == ROLE_ADMIN)
            {
            ?>
            <li class="treeview <?php echo isset($order_active)?$order_active:'' ?>">
              <a href="#">
                <i class="fa fa-list"></i> <span>Orders</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display:<?php echo isset($order_active)?'block':'none' ?>">
                <li><a href="<?php echo site_url() ?>orderListing"><i class="fa fa-circle-o text-warning"></i> All</a></li>
                <li><a href="<?php echo site_url() ?>orderPending"><i class="fa fa-circle-o text-warning"></i> Pending</a></li>
                <li><a href="<?php echo site_url() ?>orderAccepted"><i class="fa fa-circle-o text-success"></i> Accepted</a></li>
                <!--<li><a href="<?php echo site_url() ?>orderCancelled"><i class="fa fa-circle-o text-danger"></i> Cancelled</a></li>-->
              </ul>
            </li>
            
            <li class="treeview <?php echo isset($homeorder_active)?$homeorder_active:'' ?>">
              <a href="#">
                <i class="fa fa-list"></i> <span>Homeservice Orders</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display:<?php echo isset($homeorder_active)?'block':'none' ?>">
                <li><a href="<?php echo site_url() ?>homserviceOrderListing"><i class="fa fa-circle-o text-warning"></i> All</a></li>
                <li><a href="<?php echo site_url() ?>homserviceOrderPending"><i class="fa fa-circle-o text-warning"></i> Pending</a></li>
                <li><a href="<?php echo site_url() ?>homserviceOrderAccepted"><i class="fa fa-circle-o text-success"></i> Accepted</a></li>
                <!--<li><a href="<?php echo site_url() ?>homserviceOrderCancelled"><i class="fa fa-circle-o text-danger"></i> Cancelled</a></li>-->
                <li><a href="<?php echo site_url() ?>backoffice/homeServiceList"><i class="fa fa-circle-o text-warning"></i>Service List</a></li>
              </ul>
            </li>
            
            <li class="treeview <?php echo isset($business_active)?$business_active:'' ?>">
              <a href="#">
                <i class="fa fa-building"></i> <span>Businesses</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display:<?php echo isset($business_active)?'block':'none' ?>">
                  <li><a href="<?php echo site_url() ?>businessListing"><i class="fa fa-circle-o text-warning"></i> All</a></li>
                <li><a href="<?php echo site_url() ?>businessPending"><i class="fa fa-circle-o text-warning"></i> Pending</a></li>
                <li><a href="<?php echo site_url() ?>businessAccepted"><i class="fa fa-circle-o text-success"></i> Accepted</a></li>
                <li><a href="<?php echo site_url() ?>businessCancelled"><i class="fa fa-circle-o text-danger"></i> Cancelled</a></li>
              </ul>
            </li>
            <li class="treeview <?php echo isset($user_active)?$user_active:'' ?>">
              <a href="#">
                <i class="fa fa-users"></i> <span>Users</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display:<?php echo isset($user_active)?'block':'none' ?>">
                <li><a href="<?php echo site_url() ?>users"><i class="fa fa-circle-o text-warning"></i> All</a></li>
                <li><a href="<?php echo site_url() ?>usersPending"><i class="fa fa-circle-o text-warning"></i> Pending</a></li>
                <li><a href="<?php echo site_url() ?>usersAccepted"><i class="fa fa-circle-o text-success"></i> Accepted</a></li>
                <!--<li><a href="<?php echo site_url() ?>orderCancelled"><i class="fa fa-circle-o text-danger"></i> Cancelled</a></li>-->
              </ul>
            </li>
            <li>
              <a href="<?php echo site_url(); ?>userListing">
                <i class="fa fa-users"></i>
                <span>Administrative</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url(); ?>ownerListing">
                <i class="fa fa-group"></i>
                <span>Owners</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url(); ?>ownersBusiness">
                <i class="fa fa-group"></i>
                <span>Add owners to business</span>
              </a>
            </li>
            <li class="treeview <?php echo isset($setting_active)?$setting_active:'' ?>">
              <a href="#">
                <i class="fa fa-gear"></i> <span>Settings</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display:<?php echo isset($setting_active)?'block':'none' ?>">
                <li><a href="<?php echo site_url() ?>backoffice/settings/systemInfo"><i class="fa fa-circle-o"></i>Primary Info</a></li>
                <li><a href="<?php echo site_url() ?>backoffice/settings/logo"><i class="fa fa-circle-o"></i>Customize Logo</a></li>
                <li><a href="<?php echo site_url() ?>backoffice/settings/about_us"><i class="fa fa-circle-o"></i> About Content</a></li>
                <li><a href="<?php echo site_url() ?>backoffice/settings/slider"><i class="fa fa-circle-o"></i> Slider</a></li>
              </ul>
            </li>
            <?php
            }
            ?>
            <?php
            if($role == ROLE_ADMIN || $role == ROLE_MANAGER || $role == ROLE_EMPLOYEE)
            {
            ?>
            <li>
              <a href="<?php echo site_url();?>categoryListing" >
                <i class="fa fa-list-alt"></i>
                <span>Category</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url(); ?>cityListing" >
                <i class="fa fa-building"></i>
                <span>Cities</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url(); ?>areaListing" >
                <i class="fa fa-list"></i>
                <span>Areas</span>
              </a>
            </li>
            <li>
              <a href="<?php echo site_url(); ?>couponListing" >
                <i class="fa fa-gift"></i>
                <span>Coupons</span>
              </a>
            </li>
            <?php } ?>
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>