<?php 
	$this->load->view('restaurant_header');
?>		
                <div class="row">
                	<div class="panel panel-default">
                              <div class="panel-heading">
                                <h3 class="panel-title">Your Order</h3>
                              </div>
                              <div class="panel-body">
                              
							  <?php if (!empty($message)) : ?>
                                <div class="alert alert-success">
                                	<?php echo $message; ?>
                                </div> 
								
                              
                              <div class="hidden">
                              	<input type="hidden" name="order_md5" value='<?php echo serialize($order); ?>' />
                              </div>
                              <h4>
                              	Your Order
                              </h4>
                              <div class="table-responsive">
                              	<table class="table table-striped table-bordered table-hover">
                                	<thead>
                                    	<tr>
                                        	<th colspan="4">Food Item</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										foreach($order as $key => $value)
										{
											$item = $this->rest->getMenuItemDetails($key);
											$cost = $item->price * $value;
											echo '
												<tr>
													<td colspan="4">'.$item->name.'</td>
													<td>₦'.number_format($item->price).'</td>
													<td>'.$value.'</td>
													<td>₦'.number_format($cost).'</td>
												</tr>
											';
										}
									?>
                                    	<tr>
                                        	<td colspan="5"></td>
                                            <th>Delivery Fee</th>
                                            <td>₦<?php echo number_format($restaurant->delivery_fee); ?></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="5"></td>
                                            <th>Service Fee (<?php echo number_format($restaurant->service_fee); ?>%)</th>
                                            <td>₦<?php echo number_format($service_fee); ?></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="5"></td>
                                            <th>Total</th>
                                            <td>₦<?php echo number_format($total); ?></td>
                                        </tr>
                                    </tbody>
                              	</table>
                                <h4>Custom Order</h4>
                                	<?php 
									if(!empty($customOrder))
										echo $customOrder; 
									else echo "None!";
								?>
                              </div>
                              
                              <h4>Order Details</h4>
                              <div class="order-detail">
                                  <div class="row">
                                  	<div class="col-md-12">
                                    <label style="margin-top:10px;">Name</label><br />
                                    <span><?php echo $name; ?></span>
                                    </div>
                                  </div>
                                  <div class="row">
                                  	<div class="col-md-12">
                                    <label style="margin-top:10px;">Address</label><br />
                                    <span><?php echo $address; ?></span>
                                    </div>
                                  </div>
                                  <div class="row">
                                  	<div class="col-md-6">
                                    	<label style="margin-top:10px;">Email</label><br />
                                    	<span><?php echo $email; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                    	<label style="margin-top:10px;">Phone Number</label><br />
                                    	<span><?php echo $phone_no; ?></span>
                                    </div>
                                  </div>
                                <!--  <div class="row">
                                  	<div class="col-md-12">
                                  	<label style="margin-top:10px;">Additional Info</label><br />
                                    <span><?php echo $add_info; ?></span>
                                    </div>
                                  </div>
                                  -->
                              </div>
                              
                              <?php
							  	else :
							  ?>
                              	<div class="alert alert-danger">
                                	<?php echo $error; ?>
                                </div> 
                              <?php 
							  	endif;
							  ?>
                            </div>
                            
                            </div>
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
								<a href="'.site_url('restaurant/'.$similar->slug).'"><div class="row block  listing">
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