<?php 
	$this->load->view('restaurant_header');
?>
                <div class="row">
                	<h3><?php echo $message ?></h3>
                    <a href="<?php echo site_url('restaurant/'.$restaurant->slug); ?>">Go back to restaurant</a>
                    
                </div>
              <!-- Tab panel -->
            </div>
            <div class="col-md-4">
            	<div class="block sidebar">
                	<h3>
                    	Regular Hours
                    </h3>
                    <ul>
                    	<?php
						if(!empty($hours))
					{
						$days = array(0,1,2,3,4,5,6,);
						foreach($days as $time)
						{
							$open = "open_".$time;
							$close = "close_".$time;
							if($hours->$open == "00:00:00" && $hours->$close == "00:00:00")
							{
								echo '
									<li><b>'.$this->rest->dayOfWeek($time).': </b>Closed</li>
								';
							}
							else {
							echo '
								<li><b>'.$this->rest->dayOfWeek($time).': </b>'.date('g:ia', strtotime($hours->$open)).' - '.date('g:ia', strtotime($hours->$close)).'</li>
							';
							}
						}
					}
						?>
                    </ul>
                    <br>
                    
                    <h3>Similar Spots</h3>
                    <?php
					$similar_count = 0;
						foreach($similar_spots as $similar)
						{
							echo '
								<a href="'.site_url('restaurant/'.$similar->slug).'"><div class="row block listing">
                		<div class="rest-image">
                    	<img src="'.$this->rest->getPicture($similar->id).'" alt="'.$similar->rest_name.'" />
                		</div>
                        <div class="rest-details">
                            <span class="rest-name">'.$similar->rest_name.'</span><br>
                            
                        </div>
            		</div>
                    </a>
							';
							$similar_count++;
						}
						if($similar_count == 0)
						{
							echo "No similar spots found for this restaurant!";
						}
					?>
                </div>
            </div>
        </div>