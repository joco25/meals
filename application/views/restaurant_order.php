<?php 
	$this->load->view('restaurant_header');
?>
                <div class="row">
                	<div class="panel panel-default">
                              <div class="panel-heading">
                                <h3 class="panel-title">Complete Your Order</h3>
                              </div>
                              <div class="panel-body">
                             
                              <?php echo form_open('restaurant/'.$restaurant->slug.'/confirm'); ?>
                              <h4>Enter Personal Details</h4>
                              <div class="row">
                              	<div class="col-md-6">
                                	<label>Name</label>
                                    <input type="text" name="name" id="name"  class="form-control" placeholder="e.g John Doe" <?php if($this->session->userdata('email') !== FALSE){ echo 'value="'.$this->session->userdata('name').'"';} ?>>
                                </div>
                                <div class="col-md-6">
                                	<label>Email</label>
                                    <input type="email" name="email" id="email"  class="form-control" placeholder="e.g johndoe@gmail.com" <?php if($this->session->userdata('email') !== FALSE){ echo 'value="'.$this->session->userdata('email').'"';} ?>>
                                </div>
                              </div>
                              <div class="row">
                              	<div class="col-md-6">
                                	<label style="margin-top:10px;">Phone No</label>
                                    <input type="text" name="phone_no" id="phone_no"  class="form-control" placeholder="e.g 070xxxxxxxx">
                                </div>
                                <div class="col-md-6">
                                	<label style="margin-top:10px;">Delivery Address</label>
                                    <input type="text" name="address" id="address"  class="form-control" placeholder="e.g 2, Hainat Augusto Close">
                                </div>
                              </div>
                              <!--<label style="margin-top:10px;">Additional Info</label>
                              <textarea name="add_info" class="form-control"></textarea>-->
                              <div class="hidden">
                                <input type="hidden" name="preorder" value="<?php if(!$this->rest->getOpenStatus($restaurant->id)) {echo "1";} else echo 0; ?>" />
                              </div>
                              <h4>Custom Order</h4>
                              		<input type="hidden" name="customOrder" value="<?php echo $customOrder; ?>"/>
                              	<?php 
									if(!empty($customOrder))
										echo $customOrder; 
									else echo "None!";
								?>
                                
                                <br />
                              <h4>
                              	Your Cart
                              </h4>
                              <div class="table-responsive">
                              	<div id="cart_content">
								<?php if(!$this->cart->contents()):
                                    echo 'You don\'t have any items yet.';
                                else:
                                ?>
                                <table class="table table-striped table-bordered table-hover" width="100%" cellpadding="0" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Qty</th>
                                            <th>Item</th>
                                            <th>Price</th>
                                            <th>Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;?>
                                        <?php foreach($this->cart->contents() as $items): ?>
                                         
                                        <?php echo form_hidden('rowid[]', $items['rowid']); ?>
                                        <tr <?php if($i&1){ echo 'class="alt"'; }?>>
                                            <td>
                                                <?php echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?>
                                            </td>
                                             
                                            <td><?php echo $items['name']; ?></td>
                                            <td>₦<?php echo $this->cart->format_number($items['price']); ?></td>
                                            <td>₦<?php echo $this->cart->format_number($items['subtotal']); ?></td>
                                        </tr>
                                         
                                        <?php $i++; ?>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td</td>
                                            <td colspan="1"></td>
                                            <td colspan="2" align="right"><strong>Delivery Fee:</strong></td>
                                            <td>₦<?php echo number_format($restaurant->delivery_fee); ?></td>
                                        </tr>
                                         <tr>
                                            <td</td>
                                            <td colspan="1"></td>
                                            <td colspan="2" align="right"><strong>Service Fee (<?php echo $restaurant->service_fee; ?>%):</strong></td>
                                            <td>₦<?php 
												$service_fee = $restaurant->service_fee * $this->cart->total() / 100;
												echo number_format($service_fee); 
											?></td>
                                        </tr>
                                        <tr>
                                            <td</td>
                                            <td colspan="1"></td>
                                            <td colspan="2" align="right"><strong>Total</strong></td>
                                            <td>₦<?php 
													$total = $restaurant->delivery_fee + $service_fee + $this->cart->total();
													echo number_format($total); 
												?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                 <input type="hidden" name="total" value="<?php echo $total; ?>" />
                                <p><button class="btn" name="back" onclick="window.history.go(-1); return false;">Go Back</button>&nbsp;<?php echo anchor('restaurant/'.$restaurant->slug.'/empty_cart', 'Empty Cart', 'class="empty btn btn-danger"');?></p>
                                <?php 
                               
                                endif;
                                ?>
                            </div>
                              </div>
                              
                              <div class="row">
                                	<div class="col-xs-3">
                                    	<?php
                                        $total = $this->cart->total();
											if($total < $restaurant->minimum_order && empty($customOrder))
											{
												echo '<button class="btn" name="back" onclick="window.history.go(-1); return false;">Go Back</button>';
											}
										?>
                                	</div>
                                    <div class="col-xs-9">
                                    	<?php
										
											if($total < $restaurant->minimum_order && empty($customOrder))
											{
												echo '
												
													<div class="alert alert-danger">
														Your order is less than the minimum order (₦'.number_format($restaurant->minimum_order).') required for this restaurant. Please go back and update your order!
													</div>
												';
											}
											else {
												echo '
												<div class="pull-right">
													<label><input type="radio" checked name="payment" value="delivery"> Pay on Delivery</label>&nbsp;&nbsp;
													';
													if($restaurant->allow_pre_payment)
													{
														echo '<label><input type="radio" name="payment" value="card"> Pay now with Card</label>
													';
													}
													echo '
													</div>
												';
											}
										 ?>
                                    </div>
                                </div>
                                <?php
										if($total >= $restaurant->minimum_order || !empty($customOrder))
											{
										echo '
										
													<div class="pull-right">
														<input type="submit" class="btn" name="order" onclick="return valData();" value="Confirm Order" />
													</div>
												';
											}
									?>
                              </form>
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
        
        <script type="text/javascript">
		
		function valData()
		{
			var name = document.getElementById('name').value;
			var email = document.getElementById('email').value;
			var phone_no = document.getElementById('phone_no').value;
			var address = document.getElementById('address').value;
			
			if(name == "" || email == "" || phone_no == "" || address == "")
			{
				alert("All Fields are required!");
				return false;
			}
			else
			{
			 return true;
			}
			
		}
		</script>