<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Admin Dashboard - States</h2>   
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
                             States
                        </div>
                        <div class="panel-body">
                        <span style="color:#f30">*Add new state below</span>
                        	<div class="table-responsive">
                            	<?php echo form_open('panel/states/'); ?>
                                <table class="table table-striped table-bordered table-hover"> 
                                    <tbody id="deal">
                                    <tr>
                                                    <td><input type="text" name="state" class="form-control" placeholder="Name of State" required></td>
                                                    
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
                                                <th>State</th>
                                                <th></th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										$counter = 1;
											foreach($states as $state)
											{
												echo '
													<tr>
														<td>'.$counter++.'</td>
														<td>'.$state->name.'</td>
														<td><a href="'.site_url('panel/states/edit/'.$state->id).'" class="btn btn-primary btn-sm">Edit</a> <a href="'.site_url('panel/states/delete/'.$state->id).'" class="btn btn-danger btn-sm">Delete</a></td>
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