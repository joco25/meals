<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard</h2>   
                        <h5>Welcome <?php echo $this->session->userdata('name'); ?>, Love to see you back. </h5>
                        <h4 style="color: #0FF;">Your Sms balance is : <?php echo $this->sms->getEbulksmsBalance(); ?> </h4>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-bell-o"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"><?php echo $pending_orders; ?> Orders</p>
                    <p class="text-muted">PENDING</p>
                </div>
             </div>
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-bars"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"><?php echo $in_progress_orders; ?> Orders</p>
                    <p class="text-muted">IN-PROGRESS</p>
                </div>
             </div>
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-blue set-icon">
                    <i class="fa fa-rocket"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"><?php echo $completed_orders; ?> Orders</p>
                    <p class="text-muted">COMPLETED</p>
                </div>
             </div>
		     </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <span class="icon-box bg-color-brown set-icon">
                    <i class="fa fa-bar-chart-o"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"><?php echo $reg_restaurants; ?> Restaurants</p>
                    <p class="text-muted">REGISTERED</p>
                </div>
             </div>
		     </div>
			</div>
                 <!-- /. ROW  -->
                <hr />
                <?php if($pending_orders > 0) : ?>                
                <div class="row">
                	<div class="col-md-12">
                    	<div class="panel panel-primary">
                            <div class="panel-heading">
                                New Orders
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Restaurant</th>
                                                <th>Total Price</th>
                                                <th>Payment type</th>
                                                <th>Order ID</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
										$counter = 1;
											foreach($pending as $order)
											{
												echo '
													<tr>
														<td>'.$counter++.'</td>
														<td><b>'.$order->client_name.'</b><br><small>'.date('D, d M Y H:i:s', $order->timestamp).'</small></td>
														<td>'.$order->client_email.'</td>
														<td>'.$this->rest->getRestDetail($order->rest_id, 'rest_name').'</td>
														<td><b>₦'.number_format($order->total_price).'</b></td>
														<td>'.$order->payment_type.'</td>
														<td>#'.$order->id.'</td>
														<td><span class="label label-warning">'.$order->status.'</span></td>
														
														<td><a href="'.site_url('panel/order/'.$order->id).'" class="btn btn-primary btn-sm">Process</a></td>
													</tr>
												';
											}
										 ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Active Orders
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                         <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Restaurant</th>
                                                <th>Total Price</th>
                                                <th>Payment type</th>
                                                <th>Order ID</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$counter = 1;
											foreach($processed as $order)
											{
												echo '
													<tr>
														<td>'.$counter++.'</td>
														<td><b>'.$order->client_name.'</b><br><small>'.date('D, d M Y H:i:s', $order->timestamp).'</small></td>
														<td>'.$order->client_email.'</td>
														<td>'.$this->rest->getRestDetail($order->rest_id, 'rest_name').'</td>
														<td><b>₦'.number_format($order->total_price).'</b></td>
														<td>'.$order->payment_type.'</td>
														<td>#'.$order->id.'</td>';
														$class = $this->order->getOrderStatus($order->status);
														echo '
														<td><span class="'.$class.'">'.$order->status.'</span></td>
														';
														echo '
														<td><a href="'.site_url('panel/order/'.$order->id).'" class="btn btn-primary btn-sm">Process</a></td>
													</tr>
												';
											}
										 ?>
                                    </tbody>
                                </table>
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