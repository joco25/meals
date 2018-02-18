<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MealDeal Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="<?php echo panel_assets_url(); ?>css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="<?php echo panel_assets_url(); ?>css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="<?php echo panel_assets_url(); ?>js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="<?php echo panel_assets_url(); ?>css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url('panel/home'); ?>"><img src="<?php echo panel_assets_url(); ?>img/logo.png" alt="mealdeal admin" width="90%" /></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> <a href="<?php echo site_url('panel/login/logout') ?>" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="<?php echo panel_assets_url(); ?>img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a <?php if($active_page == 'home') echo 'class="active-menu"'; ?> href="<?php echo site_url('panel/home'); ?>"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a <?php if($active_page == 'restaurant') echo 'class="active-menu"'; ?> href="#"><i class="fa fa-qrcode fa-3x"></i> Restaurants<span class="fa arrow"></a>
                        	 <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('panel/restaurant/'); ?>">View Restaurants</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('panel/restaurants/new'); ?>">Newly Added Restaurants</a>
                                </li>
                           	</ul>
                    </li>
						   <li  >
                        <a <?php if($active_page == 'deals') echo 'class="active-menu"'; ?>  href="chart.html"><i class="fa fa-bar-chart-o fa-3x"></i> Deals</a>
                        	<ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('panel/deals'); ?>">View Deals</a>
                                </li>
                           	</ul>
                    </li>	
                    <li  >
                        <a <?php if($active_page == 'reviews') echo 'class="active-menu"'; ?>  href="<?php echo site_url('panel/reviews'); ?>"><i class="fa fa-edit fa-3x"></i> Reviews </a>
                    </li>
                   <!-- <li  >
                        <a <?php if($active_page == 'users') echo 'class="active-menu"'; ?>  href="<?php echo site_url('panel/users'); ?>"><i class="fa fa-bars fa-3x"></i> Users </a>
                    </li>-->
                    <li  >
                        <a <?php if($active_page == 'states') echo 'class="active-menu"'; ?>  href="<?php echo site_url('panel/states'); ?>"><i class="fa fa-rocket fa-3x"></i> States </a>
                    </li>				              
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->