<html>
<head></head>

<link href="<?php echo asset_url() ;?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset_url() ;?>css/styles.css" rel="stylesheet">
    <body style="padding:10px;">
    	<div class="row" style="text-align:center; background:#B40912;">
        	<a href="<?php echo site_url(); ?>"><img style="height:auto;" src="<?php echo asset_url() ;?>images/logo.png"/></a>
        </div>
        <div class="container">
                <div class="row responsive">
                <div class="center">
                <h3>Your order on <a href="<?php echo site_url(); ?>">Mealdeal.com.ng</a> has been recieved and being processed. Here are your order details</h3>
                </div>
                	<div class="panel panel-default">
                              <div class="panel-heading">
                                <h3 class="panel-title">Your Order</h3>
                              </div>
                              <div class="panel-body">
                              
                              
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
                              </div>
                              
                              <h4>Order Details</h4>
                              <div class="order-detail">
                                  <div class="row">
                                  	<div class="col-md-12">
                                    <label style="margin-top:10px;"><b>Name:</b></label><br />
                                    <span><?php echo $name; ?></span>
                                    </div>
                                  </div>
                                  <div class="row">
                                  	<div class="col-md-12">
                                    <label style="margin-top:10px;"><b>Address:</b></label><br />
                                    <span><?php echo $address; ?></span>
                                    </div>
                                  </div>
                                  <div class="row">
                                  	<div class="col-md-6">
                                    	<label style="margin-top:10px;"><b>Email:</b></label><br />
                                    	<span><?php echo $email; ?></span>
                                    </div>
                                    <div class="col-md-6">
                                    	<label style="margin-top:10px;"><b>Phone Number:</b></label><br />
                                    	<span><?php echo $phone_no; ?></span>
                                    </div>
                                  </div>
                                  <div class="row">
                                  	<div class="col-md-12">
                                  	<label style="margin-top:10px;"><b>Additional Info:</b></label><br />
                                    <span><?php echo $add_info; ?></span>
                                    </div>
                                  </div>
                              </div>
                              
                              
                            </div>
                            </div>
                </div>
              <!-- Tab panel -->
              </div>
            </div>
        </div>
        </body>
        </body>