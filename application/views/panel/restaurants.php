<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard - Restaurants</h2>   
                        <h5>Welcome <?php echo $this->session->userdata('name'); ?>, Love to see you back. </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Active Restaurants
                             <a href="<?php echo site_url('add-restaurant'); ?>" class="btn btn-primary btn-sm">Add New Restaurant</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                         <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Email</th>
                                                <th>Contact Person</th>
                                                <th>Phone No</th>
                                                <th>Added By</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Date Added</th>
                                                <th></th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$counter = 1;
											foreach($restaurants as $restaurant)
											{
												echo '
													<tr>
														<td>'.$counter++.'</td>
														<td><b>'.$restaurant->rest_name.'</b></td>
														<td>'.$restaurant->rest_address.'</td>
														<td>'.$restaurant->rest_email.'</td>
														<td>'.$restaurant->contact_person.'</td>
														<td>'.$restaurant->phone_no.'</td>
														<td>'.$restaurant->your_email.'</td>
														<td>'.$restaurant->rest_city.'</td>
														<td>'.$restaurant->rest_state.'</td>
														<td>'.date('D, d M Y H:i:s', strtotime($restaurant->date_added)).'</td>
														';
														echo '
														<td><a href="'.site_url('panel/restaurant/'.$restaurant->slug.'/edit').'" class="btn btn-primary btn-sm">Edit</a></td>
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