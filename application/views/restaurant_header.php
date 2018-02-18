<style>
	#rest-back {
		background-image: url('<?php echo $this->rest->getBanner($restaurant->id); ?>');
		height: 300px;
		background-size: cover;
    	background-position: 50% 50%;
	}
</style>
<div class="container full restaurant">
        	<div class="col-md-1">
            </div>
        	<div class="col-md-7">
                <div class="row" id="rest-back">    
                    <div class="rest-image">
                        <img src="<?php echo $this->rest->getPicture($restaurant->id); ?>" alt="<?php echo $restaurant->rest_name; ?>" />
                    </div>
                    <div class="rest-details">
                         <a class="no-hover" href="<?php echo site_url('restaurant/'.$restaurant->slug); ?>"><h3 class="rest-name"><?php echo $restaurant->rest_name; ?></h3></a>
                        <!--<?php echo $this->rest->statusMessage($restaurant->id) ?>-->
                        <address><small><?php echo $restaurant->rest_address.', '.$restaurant->rest_state; ?></small></address>
                    </div>
                </div>
                
                <br />
