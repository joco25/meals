 <div class="container block search">
        
            <div class="row">
                <div class="col-md-12">
                    <p><?php echo $search_count; ?> search results for "<?php echo $keyword; ?> in <?php echo $location; ?>"</p>
                </div>
            </div>
            <div class="container">
            <!--Sidebar-->
            	<div class="col-md-3 filters">
                	<?php echo form_open('search'); ?>
                    <div class="row"> 
                    	<div class="col-md-12">
                            <div class="input-group">
                              <input type="text" placeholder="Search Restaurants" name="keyword" class="form-control" value="<?php echo $keyword; ?>">
                              <span class="input-group-btn">
                                <input class="btn btn-default" type="submit" value="Go!" />
                              </span>
                            </div>
                        </div>
                	</div>
                    <div class="row">
					  <div class="col-md-6">
                            <select class="form-control" name="location">
								<?php foreach($states as $state) {
                                    echo "<option value='".$state->name."'>".$state->name."</option>";
                                }
                                ?>
                            </select>
                       </div>
                    </div>
                    </form>
                    <!--<?php echo form_open('search/filter'); ?>
                	<h3>Filter Restaurants</h3>
                    <ul>
                    	<li><label><input type="checkbox" name="check1" value="check1"> Free Delivery</label></li>
                        <li><label><input type="checkbox" name="check1" value="check1"> Open Restaurants</label></li>
                        <li><label><input type="checkbox" name="check1" value="check1"> Preorder Available</label></li>
                        <li><label><input type="checkbox" name="check1" value="check1"> Catering</label></li>
                    </ul>
                    <input type="submit" name="filter" value="Filter Search" class="btn btn-primary" />
                    </form>
                    --> 
                </div>
             <!-- End of sidebar -->
             <div class="col-md-1">
             </div>
             <!-- Main Results -->
                <div class="col-md-8">
                
                <div class="row block ">
                	<p>Sort By: <a href="<?php echo site_url('search/sort/rating'); ?>">Ratings</a> | <a href="<?php echo site_url('search/sort/delivery_fee'); ?>">Delivery Fee</a> | <a href="<?php echo site_url('search/sort/minimum_order'); ?>">Minimum order value</a></p>
                </div>
                
                <?php foreach($results as $restaurant) {
							echo '
								<a href="'.site_url('restaurant/'.$restaurant->slug).'">
							<div class="rest-listing" style="height:180px;width:300px;background-image: url('.$this->rest->getBanner($restaurant->id).');background-size: cover;background-position: 50% 50%;float:left;padding-top:90px;color: #FFF;
    font-weight: bold;
    font-family: Tahoma, Geneva, sans-serif;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 2px;">
								'.$restaurant->rest_name.'
							</div>
							</a>
							
							';
						}
				?>
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
        
        