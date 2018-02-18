<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard - Deals</h2>   
                        <h5>Welcome <?php echo $this->session->userdata('name'); ?>, Love to see you back. </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                  <?php
				  	if(isset($success)) 
					{
						echo '
							<div class="alert alert-success">
                    			'.$success.'
                    		</div>
						';
					}
					else if(isset($error))
					{
						echo '
							<div class="alert alert-success">
                    			'.$error.'
                    		</div>
						';
					}
				  ?>
                <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Deals
                        </div>
                        <div class="panel-body">
                        <span style="color:#f30">*Add new deal below</span>
                        	<div class="table-responsive">
                            	<?php echo form_open('panel/deals/'); ?>
                                <table class="table table-striped table-bordered table-hover"> 
                                    <tbody id="deal">
                                    <tr>
													<td><select class="form-control input-sm" name="restaurant">
														<?php foreach($restaurants as $restaurant) {
                                                            echo "<option value='".$restaurant->id."'>".$restaurant->rest_name."</option>";
                                                        }
                                                        ?>
                                                    </select></td>
                                                    <td><input type="number" name="percent" class="form-control" placeholder="percent" required></td>
                                                    
												</tr>
                                    </tbody>
                                 </table>
                                  <div class="pull-right">
                                	<input type="submit" name="add_item" class="btn btn-info" value="Save" />
                                </div>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                         <tr>
                                                <th>#</th>
                                                <th>Restaurant</th>
                                                <th>Percent</th>
                                                <th>Last Updated</th>
                                                <th></th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$counter = 1;
											foreach($deals as $deal)
											{
												echo '
													<tr>
														<td>'.$counter++.'</td>
														<td>'.$this->rest->getRestDetail($deal->rest_id, 'rest_name').'<br/> <small>'.$this->rest->getRestDetail($deal->rest_id, 'rest_address').', '.$this->rest->getRestDetail($deal->rest_id, 'rest_city').' '.$this->rest->getRestDetail($deal->rest_id, 'rest_state'); ?><br> <?php echo $this->rest->getRestDetail($deal->rest_id, 'phone_no'). '</small>'.'</td>
														<td>'.$deal->percent.'</td>
														<td>'.date('D, d M Y', strtotime($deal->last_updated)).'</td>
														<td><a href="'.site_url('panel/deals/edit/'.$deal->id).'" class="btn btn-primary btn-sm">Edit</a></td>
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