<?php 
	$this->load->view('restaurant_header');
?>
                <div class="row">
                	<div role="tabpanel">
                    <!-- Nav tabs -->
                
                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="menu">
                            <div class="responsive">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h3 class="panel-title">Make Your Order</h3>
                              </div>
                              <div class="panel-body category-menu">
                              		<?php
										foreach($categories as $category) :
												echo '<h3 style="text-transform:uppercase;">'.$category->cat_name.'</h3>'; 	
												$cat_menu = $this->rest->getMenuFromCategory($category->id);
									?>
                                    	<ul>
                                    	<?php
											$counter = 0;
											foreach($cat_menu as $item) :
											
												echo '
													<li class="col-sm-6 menu-item" data-toggle="modal" data-target="#myModal-'.$item->id.'">
														<div class="col-xs-9">
														<h4 >
																'.$item->name.'
														</h4>
														</div>
														<div class="price col-xs-3">
														  ₦'.$item->price.'
														</div>
														<div class="clearfix"></div>
													</li>
													<div id="myModal-'.$item->id.'" class="modal fade" role="dialog">
													  <div class="modal-dialog">
														<!-- Modal content-->
														<div class="modal-content menu-item-modal">
															'.form_open('cart/add_cart_item').'
														  <div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">'.$item->name.'</h4>
														  </div>
														  <div class="modal-body">
															<h4> ₦'.$item->price.'</h4>
															<h5>'.$item->description.'</h5>
															
															'.form_hidden('item_id', $item->id).'
															<br>
															<label>SPECIAL INSTRUCTIONS: </label>
															<textarea name="instructions" class="form-control"></textarea>
														  </div>
														  <div class="modal-footer">
														  	<div class="price col-md-3 col-xs-3" style="text-align:left;">
																<label>Quantity: </label>
															  <input value="1" name="quantity" class="form-control" type="number" />
															</div>
															<br>
															<button type="submit" class="btn btn-default">ADD TO CART</button>
														  </div>
														  '.form_close().'
														</div>
													
													  </div>
													</div> 
												';
												$counter++;
												if(!($counter % 2))
													echo '<div style="clear:both"></div>';
											endforeach;
										 ?>   
                                         <div style="clear:both"></div>
                                    </ul>
                                    <?php
										endforeach;
									?>
                                    <h3 >ADD YOUR CUSTOM ORDER</h3>
                                    <form name="c_order" method="post" action="<?php echo site_url('restaurant/'.$restaurant->slug.'/order'); ?>">
                                    <textarea name="customOrder" id="customOrder" placeholder="Add your items here" class="form-control"></textarea>
                                    <button type="reset" name="reset" class="search-btn btn ">CLEAR</button>
                                    
                                   <button class="btn btn-success" type="submit" name="submitBtn">CHECKOUT</button></form>
                              </div>
                            </div>
                        </div>
                        </div>
                        <!-- Menu -->
                    </div>
                <!-- Tab Content -->
              </div>
              	</div>
              <!-- Tab panel -->
            </div>
            <div class="col-md-4">
            	<div class="block sidebar">
                	
                    <div id="cart_content">
                    <h3>Your Shopping cart</h3>
            <?php if(!$this->cart->contents()):
				echo 'You don\'t have any items yet.';
			else:
			?>
			 
			<?php echo form_open('cart/update_cart'); ?>
			<table class="table table-responsive table-striped table-bordered table-hover" width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<td>Qty</td>
						<td>Item</td>
						<td>Price</td>
						<td>Cost</td>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
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
						<td></td>
						<td colspan="2"><strong>Total</strong></td>
						<td>₦<?php echo $this->cart->format_number($this->cart->total()); ?></td>
					</tr>
				</tbody>
			</table>
			 
			<p><?php echo anchor('restaurant/'.$restaurant->slug.'/empty_cart', 'Empty Cart', 'class="empty btn btn-danger"');?></p>
			<!--<p><small>If the quantity is set to zero, the item will be removed from the cart.</small></p>-->
			<?php 
			echo form_close(); 
			endif;
			?>
        </div>
                    <br />
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
        <script>
	$(document).ready(function() { 
	
		$(".menu-item-modal form").submit(function() {
			// Get the product ID and the quantity 
			var id = $(this).find('input[name=item_id]').val();
			var qty = $(this).find('input[name=quantity]').val();
			var instruct = $(this).find('textarea[name=instructions]').val();
			
			//alert('ID:' + id + '\n\rQTY:' + qty);
			$("#cart_content").html("<b>Loading!!!!</b>");
			$("#myModal-"+id).modal('hide');
			
			$.post('<?php echo site_url('restaurant/'.$restaurant->slug.'/add_cart_item'); ?>', { product_id: id, quantity: qty, ajax: '1', instructions: instruct },
  				function(data){	
 		 			if(data == 'true'){
 		 			
    					$.get('<?php echo site_url('restaurant/'.$restaurant->slug.'/show_cart'); ?>', function(cart){ // Get the contents of the url cart/show_cart
  							$("#cart_content").html(cart); // Replace the information in the div #cart_content with the retrieved data
						}); 		 
										
 		 			}else{
 		 				alert("Product does not exist");
 		 			}
					console.log(data);
 			 });
			
			return false; // Stop the browser of loading the page defined in the form "action" parameter.
		});
	
	});
	$(".empty").on("click", function(){
    	$.get('<?php echo site_url('restaurant/'.$restaurant->slug.'/empty_cart'); ?>', function(){
    		$.get('<?php echo site_url('restaurant/'.$restaurant->slug.'/show_cart'); ?>', function(cart){
  				$("#cart_content").html(cart);
			});
		});
		
		return false;
    });
</script>