<style>
#result .show {
	padding:5px;
	border-bottom: 1px solid #eee;
	font-size:12px;
}
</style>
<div class="container-fluid" id="slider">
        	<div class="home-search">
                <h2 style="color:#fff; margin-top:2.5em; margin-botton: 0.5em;" >Order from restaurants and stores in your city.</h2>
                <?php echo form_open('search'); ?>
				<div class="row">                
                    <div class="col-md-7">
                    	<div class="input-group">
                          <span class="input-group-addon"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></span>
                          <input class="form-control input-lg search" type="text" id="searchid" name="keyword" placeholder="Enter Restaurant Name, City or Cuisine" autocomplete="off" required="required" />
                          
                        </div>
<div id="result" style="background:#fff;"></div>
                    
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-5">
                    <select class="form-control input-lg" name="location">
                        <?php foreach($states as $state) {
							echo "<option value='".$state->name."'>".$state->name."</option>";
						}
						?>
                    </select>
                    </div>
                </div>
                <div class="row">
                <input type="submit" name="submit" class="btn-success btn-lg " value="Find Restaurants &raquo;" />
                </div>
                </form>
            </div>
        </div>
        <div class="container home" style="margin-top:30px;">
        	<div class="row">

				<h2 class="text-center" style="padding-bottom:0.3em;">Express delivery accross Nigeria</h2>
            
                <div class="col-md-4 col-xs-12 text-center">
                    <a href="<?php echo site_url('view/stateRestaurants/abuja'); ?>"><img class="thumbnail spotimg" src="<?php echo asset_url() ?>images/abuja.jpg" alt="item7" /></a>
                    <p class="text-center"><h4>Abuja</h4>
                    Order from our restaurants in the Fedral Capital territory of Nigeria</p>
                </div>
                <div class="col-md-4 col-xs-12 text-center">
                    <a href="<?php echo site_url('view/stateRestaurants/lagos'); ?>"><img class="thumbnail spotimg" src="<?php echo asset_url() ?>images/lagos.jpg" alt="item7" /></a>
                    <p class="text-center"><h4>Lagos</h4>
										Order from our prestigious restaurants in the beautiful city of Lagos
                    </p>
                </div>
                <div class="col-md-4 col-xs-12 text-center">
                    <a href="<?php echo site_url('view/stateRestaurants/kwara'); ?>"><img class="thumbnail spotimg" src="<?php echo asset_url() ?>images/ilorin.jpg" alt="item7" /></a>
                    <p class="text-center"><h4>Ilorin</h4>
										Order from our restaurants in the city of Ilorin
                    </p>
                </div>
          	</div>
        </div>

		<div class="msg">
			<h2>What we say</h2>
			<blockquote align="center">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget leo nunc, nec tempus mi? Curabitur id nisl mi, ut vulputate urna. Quisque porta facilisis tortor, vitae bibendum velit fringilla vitae! Lorem ipsum dolor sit amet, consectetur adipiscing elit!
				<cite>mealdeal</cite>
			</blockquote>
		</div>

		<div class="restaurants" style="margin-top:50px;">
			<h3 align="center" style="padding-bottom: 0.4em;border-bottom: 1px solid #0000;">Make your choice</h3>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
  
    <div class="item active container">
        <img class="col-md-2 col-sm-2 col-xs-2 logos img-circle" src="<?php echo asset_url() ?>images/chickenrepublic.png" alt="...">
        <img class="col-md-2 col-sm-2 col-xs-2 logos img-circle" src="<?php echo asset_url() ?>images/kfc.png" alt="...">
        <img class="col-md-2 col-sm-2 col-xs-2 logos img-circle" src="<?php echo asset_url() ?>images/item7.png" alt="...">
		<img class="col-md-2 col-sm-2 col-xs-2 logos img-circle" src="<?php echo asset_url() ?>images/molly.png" alt="...">
		<img class="col-md-2 col-sm-2 col-xs-2 logos img-circle" src="<?php echo asset_url() ?>images/mamacass.png" alt="...">
		<img class="col-md-2 col-sm-2 col-xs-2 logos img-circle" src="<?php echo asset_url() ?>images/mixedgrills.png" alt="...">
        
    </div>
    
    <div class="item container">
        <img class="col-md-2 col-sm-2 col-xs-2 logos img-circle" src="<?php echo asset_url() ?>images/chickenchilli.png" alt="...">
        <img class="col-md-2 col-sm-2 col-xs-2 logos img-circle" src="<?php echo asset_url() ?>images/mixedgrills.png" alt="...">
        <img class="col-md-2 col-sm-2 col-xs-2 logos img-circle" src="<?php echo asset_url() ?>images/debonairs.png" alt="...">
		<img class="col-md-2 col-sm-2 col-xs-2 logos img-circle" src="<?php echo asset_url() ?>images/fishnnet.png" alt="...">
		<img class="col-md-2 col-sm-2 col-xs-2 logos img-circle" src="<?php echo asset_url() ?>images/kfc.png" alt="...">
		<img class="col-md-2 col-sm-2 col-xs-2 logos img-circle" src="<?php echo asset_url() ?>images/chronicles.png" alt="...">
      </div>
    
  </div>

    <div align="center" style="margin-top:20px;">
    <!-- Controls -->
          <a class="left" href="#carousel-example-generic" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right" href="#carousel-example-generic" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
    </div>
  
</div>
		</div>
		<div class="comments">
			<div class="[ container text-center ]">
				<div class="[ row ]">
					<div class="[ col-xs-12 ]" style="padding-bottom: 30px;">
						<h2>What our customers say</h2>
					</div>
				</div>
			</div>
			<div class="[ container text-center ]">
				<div class="[ row ]">
					<div class="[ col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 ]" role="tabpanel">
						<div class="[ col-xs-4 col-sm-12 ]">
							<!-- Nav tabs -->
							<ul class="[ nav nav-justified ]" id="nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#dustin" aria-controls="dustin" role="tab" data-toggle="tab">
										<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/dustinlamont/128.jpg" />
										<span class="quote"><i class="fa fa-quote-left"></i></span>
									</a>
								</li>
								<li role="presentation" class="">
									<a href="#daksh" aria-controls="daksh" role="tab" data-toggle="tab">
										<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/dakshbhagya/128.jpg" />
										<span class="quote"><i class="fa fa-quote-left"></i></span>
									</a>
								</li>
								<li role="presentation" class="">
									<a href="#anna" aria-controls="anna" role="tab" data-toggle="tab">
										<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/annapickard/128.jpg" />
										<span class="quote"><i class="fa fa-quote-left"></i></span>
									</a>
								</li>
								<li role="presentation" class="">
									<a href="#wafer" aria-controls="wafer" role="tab" data-toggle="tab">
										<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/waferbaby/128.jpg" />
										<span class="quote"><i class="fa fa-quote-left"></i></span>
									</a>
								</li>
							</ul>
						</div>
						<div class="[ col-xs-8 col-sm-12 ]">
							<!-- Tab panes -->
							<div class="tab-content" id="tabs-collapse">            
								<div role="tabpanel" class="tab-pane fade in active" id="dustin">
									<div class="tab-inner">                    
										<p class="lead">Etiam tincidunt enim et pretium efficitur. Donec auctor leo sollicitudin eros iaculis sollicitudin.</p>
										<hr>
										<p><strong class="text-uppercase">Dustin Lamont</strong></p>
										<p><em class="text-capitalize"> Student</em> at <a href="#">University of Ilorin</a></p>                 
									</div>
								</div>
								
								<div role="tabpanel" class="tab-pane fade" id="daksh">
									<div class="tab-inner">
										<p class="lead">Suspendisse dictum gravida est, nec consequat tortor venenatis a. Suspendisse vitae venenatis sapien.</p>
										<hr>
										<p><strong class="text-uppercase">Daksh Bhagya</strong></p>
										<p><em class="text-capitalize"> Electrical Engineer</em> at <a href="#">Julius Beger</a></p>
									</div>
								</div>
								
								<div role="tabpanel" class="tab-pane fade" id="anna">
									<div class="tab-inner">
										<p class="lead">Nullam suscipit ante ac arcu placerat, nec sagittis quam volutpat. Vestibulum aliquam facilisis velit ut ultrices.</p>
										<hr>
										<p><strong class="text-uppercase">Anna Pickard</strong></p>
										<p><em class="text-capitalize"> Nurse</em> at <a href="#">PG healthcare</a></p>
									</div> 
								</div>
								
								<div role="tabpanel" class="tab-pane fade" id="wafer">
									<div class="tab-inner">
										<p class="lead"> Fusce erat libero, fermentum quis sollicitudin id, venenatis nec felis. Morbi sollicitudin gravida finibus.</p>
										<hr>
										<p><strong class="text-uppercase">Wafer Baby</strong></p>
										<p><em class="text-capitalize"> Accountant</em> at <a href="#">GTbank</a></p>
									</div>
								</div>
							</div>
						</div>        
					</div>
				</div>
			</div>
		</div>
        
 <script type="text/javascript">
	$(function(){
		$(".search").keyup(function() 
		{ 
			var searchid = $(this).val();
			var dataString = 'search='+ searchid;
			if(searchid!='')
			{
				$.ajax({
				type: "POST",
				url: "<?php echo site_url('search/autocomplete'); ?>",
				data: dataString,
				cache: false,
				success: function(html)
					{
					$("#result").html(html).show();
					}
				});
			}return false;    
	});
	
	jQuery("#result").on("click",function(e){ 
		var clicked = $(e.target);
		var name = clicked.find('.name').html();
		if(!name) name = clicked.parent().find('.name').html();
		var decoded = $("<div/>").html(name).text();
		$('#searchid').val(decoded);
	});
	jQuery(document).on("click", function(e) { 
		var $clicked = $(e.target);
		if (! $clicked.hasClass("search")){
		jQuery("#result").fadeOut(); 
		$("#result").html("");
		}
	});
	$('#searchid').click(function(){
		jQuery("#result").fadeIn();
	});
});
</script>
