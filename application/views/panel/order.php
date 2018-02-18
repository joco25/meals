<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Order #<?php echo $id; ?></h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Order Details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <?php echo form_open('panel/order/'.$id); ?>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                         <tr>
                                                <th>Item</th>
                                                <th>Value</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>Client Name</b></td>
                                            <td><?php echo $order->client_name ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Client Email</b></td>
                                            <td><?php echo $order->client_email ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Client Address</b></td>
                                            <td><?php echo $order->client_address ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Client Phone Number</b></td>
                                            <td><?php echo $order->client_phone ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Time of Order</b></td>
                                            <td><?php echo date('D, d M Y H:i:s', $order->timestamp); ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Restaurant</b></td>
                                            <td><?php echo $this->rest->getRestDetail($order->rest_id, 'rest_name').'<br/> <small>'.$this->rest->getRestDetail($order->rest_id, 'rest_address').', '.$this->rest->getRestDetail($order->rest_id, 'rest_city').' '.$this->rest->getRestDetail($order->rest_id, 'rest_state'); ?><br> <?php echo $this->rest->getRestDetail($order->rest_id, 'phone_no'). '</small>' ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Order</b></td>
                                            <td>
                                            	<?php
													$user_order = unserialize($order->menu_item_ids);
													foreach($user_order as $key => $value)
													{
														$item = $this->rest->getMenuItemDetails($key);
														$cost = $item->price * $value;
														echo '
															'.$item->name.'(₦'.number_format($item->price).') x '.$value.'
																= ₦'.number_format($cost).'
															<br>
														';
													}
												 ?>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Custom Order</b></td>
                                            <td><?php echo $order->custom_order; ?></td>
                                        </tr>
                                         <tr>
                                            <td><b>Delivery Fee</b></td>
                                            <td>₦<?php echo number_format($order->delivery_fee); ?></td>
                                        </tr>
                                         <tr>
                                            <td><b>Service Fee</b></td>
                                            <td>₦<?php echo number_format($order->service_fee); ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Additional Info</b></td>
                                            <td><?php echo $order->add_info ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Total Price</b></td>
                                            <td>₦<?php echo number_format($order->total_price); ?></td>
                                        </tr>
                                        <!--<tr>
                                            <td><b>Deal Value</b></td>
                                            <td>₦<?php echo number_format($this->order->getDealValue($order->total_price, $order->deal_percent)); ?></td>
                                        </tr>-->
                                        <tr>
                                            <td><b>Last Updated By</b></td>
                                            <td><?php echo $this->order->getHandler($order->handler_id); ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Payment Type</b></td>
                                            <td><?php echo $order->payment_type ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Status</b></td>
                                            <td>
                                            <div class="row">
                                            	<div class="col-md-2">
		                                            <?php $class = $this->order->getOrderStatus($order->status);
														echo '
														<span class="'.$class.'">'.$order->status.'</span>
														';
													?>
                                                 </div>
                                                 <div class="col-md-6">
                                                 	<select name="new_status" class="form-control">
                                                        <option value="null">Change Status</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="invalid">Invalid</option>
                                                        <option value="messaged">Messaged</option>
                                                        <option value="in_progress">In Progress</option>
                                                        <option value="completed">Completed</option>
                                                        <option value="cancelled">Cancelled</option>
                                                     </select>
                                                 </div>
                                             </div>
											</td>
                                        </tr>
                                        <tr>
                                            <td><b>Order Type</b></td>
                                            <td><?php echo $order->preorder == 1? 'Pre-Order' : 'Order'; ?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                                <div class="pull-right">
                                	<input type="submit" name="save" class="btn btn-info" value="Save" />
                                </div>
                               </form>     
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->