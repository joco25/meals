 <div class="container block search">
            <div class="container">
            <!--Sidebar-->
            	<div class="col-md-1 filters">
                </div>
             <!-- Main Results -->
                <div class="col-md-10">
                <?php
					if($type == 'restaurants')
					{
						echo "<h4>Restaurants on MealDeal</h4>";
					}
					else {
						echo "<h4>Stores on MealDeal</h4>";
					}
                    if($heading){
                        echo "<h3>Restaurants in $heading</h3>";
                    }
				?>
                <?php foreach($results as $restaurant) {
							echo '
							<a href="'.site_url('restaurant/'.$restaurant->slug).'">
							<div class="rest-listing" style="height:180px;width:300px;max-width:95%;background-image: url('.$this->rest->getBanner($restaurant->id).');background-size: cover;background-position: 50% 50%;float:left;padding-top:90px;color: #FFF;
    font-weight: bold;
    font-family: Tahoma, Geneva, sans-serif;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 2px;">
								'.$restaurant->rest_name.'
							</div>
							</a>';
						}
				?>
                <div style="clear:both"></div>
                    <!--<nav>
                    	<ul class="pagination">
                        	<li class="disabled"><a href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
                        </ul>
                    </nav>-->
                </div>
             <!--End of results -->
            </div>
        </div>
        
        