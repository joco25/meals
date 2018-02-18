<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard - Reviews</h2>   
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
                             Reviews
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                         <tr>
                                                <th>#</th>
                                                <th>Restaurant</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Title</th>
                                                <th>Review</th>
                                                <th>Rating</th>
                                                <th>Date Added</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$counter = 1;
											foreach($reviews as $review)
											{
												echo '
													<tr>
														<td>'.$counter++.'</td>
														<td>'.$this->rest->getRestDetail($review->rest_id, 'rest_name').'<br/> <small>'.$this->rest->getRestDetail($review->rest_id, 'rest_address').', '.$this->rest->getRestDetail($review->rest_id, 'rest_city').' '.$this->rest->getRestDetail($review->rest_id, 'rest_state'); ?><br> <?php echo $this->rest->getRestDetail($review->rest_id, 'phone_no'). '</small>'.'</td>
														<td>'.$review->name.'</td>
														<td>'.$review->email.'</td>
														<td>'.$review->title.'</td>
														<td>'.$review->review.'</td>
														<td>'.$review->rating.' out of 5 stars</td>
														<td>'.date('D, d M Y', strtotime($review->date)).'</td>
														
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