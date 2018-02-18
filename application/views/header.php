<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MealDeal</title>
    <!-- Bootstrap -->
    <link href="<?php echo asset_url() ;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset_url() ;?>css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo asset_url() ;?>css/styles.css" rel="stylesheet">

    <!--Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Dosis:800" rel="stylesheet">

    <!--ionicons-->
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
  </head>
	  
  <body>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-59754185-1', 'auto');
	  ga('send', 'pageview');
</script> 
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
  <script src="<?php echo asset_url() ;?>js/jquery.min.js"></script>
    <div class="container full">
    
    <nav class="navbar-wrapper navbar-default navbar-fixed-top" role="navigation">
    <div class="container top">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
<!--          
            <button type="button" class="navbar-toggle" data-toggle="collapse"              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            -->
            <div class="container">
            <a class="navbar-brand logo" href="<?php echo site_url('home'); ?>"><img src="<?php echo asset_url() ;?>images/logo.png"/></a>
            <div class="fbhead btn btn-default">
            <?php
				if($this->session->userdata('email') !== FALSE)
				{
					echo '<p class="user"><img src="http://graph.facebook.com/'.$this->session->userdata('user_id').'/picture?width=32" alt="'.$this->session->userdata('name').'" />Welcome, '.$this->session->userdata('fname').'!</p>';
				}
				else {
					echo '<a href="https://graph.facebook.com/oauth/authorize?client_id=1564758173778600&redirect_uri='.base_url('login').'&scope=email" class="facebook">Sign In</a>';
				}
			?>
                
                <div class="phone-detail collapse">
                <div>
                	<p>
                    	Call +2347061837197<br>
                        <b>For your phone bookings!</b>
                    </p>
                </div>
            </div>
            </div>
            </div>
          </div>
        </div>
        </nav>
