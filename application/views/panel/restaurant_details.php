<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Restaurant - <?php echo $restaurant->rest_name; ?></h2>  
                     <div class="rest-image">
                        <img src="<?php echo $this->rest->getPicture($restaurant->id); ?>" alt="<?php echo $restaurant->rest_name; ?>" />
                    </div> 
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
                             Restaurant Details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <?php echo form_open('panel/restaurant/'.$restaurant->slug.'/edit'); ?>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                         <tr>
                                                <th>Item</th>
                                                <th>Value</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><b>Restaurant Name</b></td>
                                            <td><input type="text" class="form-control" name="rest_name" required="required" value="<?php echo $restaurant->rest_name; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Restaurant Address</b></td>
                                            <td><input type="text" class="form-control" name="rest_address" required="required" value="<?php echo $restaurant->rest_address; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Restaurant City</b></td>
                                            <td><input type="text" class="form-control" name="rest_city" required="required" value="<?php echo $restaurant->rest_city; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Restaurant State</b></td>
                                            <td>
                                            	<select class="form-control" name="rest_state">
													<?php foreach($states as $state) {
                                                        echo "<option ";
															if($state->name == $restaurant->rest_state)
															{
																echo "selected";
															}
														echo" value='".$state->name."'>".$state->name."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Contact Person</b></td>
                                            <td><input type="text" class="form-control" name="contact_person" required="required" value="<?php echo $restaurant->contact_person; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Phone Number</b></td>
                                            <td><input type="text" class="form-control" name="phone_no" required="required" value="<?php echo $restaurant->phone_no; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Restaurant Email</b></td>
                                            <td><input type="text" class="form-control" name="rest_email" required="required" value="<?php echo $restaurant->rest_email; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Date Added</b></td>
                                            <td><?php echo date('D, d M Y', strtotime($restaurant->date_added)); ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Added By</b></td>
                                            <td><input type="text" class="form-control" name="your_email" required="required" value="<?php echo $restaurant->your_email; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Cuisines</b></td>
                                            <td>
                                            	<input type="text" class="form-control" name="cuisines" required="required" value="<?php echo $restaurant->cuisines; ?>" />
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Delivery Fee</b></td>
                                            <td>₦<input type="number" class="form-control" name="delivery_fee" required="required" value="<?php echo $restaurant->delivery_fee; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Service Fee</b></td>
                                            <td><input type="number" class="form-control" name="service_fee" required="required" value="<?php echo $restaurant->service_fee; ?>" />%</td>
                                        </tr>
                                        <tr>
                                            <td><b>Estimated Delivery Time</b></td>
                                            <td>In minutes -><input type="number" class="form-control" name="delivery_time" required="required" value="<?php echo $restaurant->delivery_time; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Minimum Order</b></td>
                                            <td>₦<input type="number" class="form-control" name="minimum_order" required="required" value="<?php echo $restaurant->minimum_order; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td><b>Views</b></td>
                                            <td><?php echo $restaurant->hits; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Status</b></td>
                                            <td>
                                            	<label><input type="radio" <?php if($restaurant->status) echo 'checked="checked"'; ?>  name="status" value="1" />Activated </label>
                                                <label><input type="radio" <?php if(!$restaurant->status) echo 'checked="checked"'; ?> name="status" value="0" />Inactive</label>
											</td>
                                        </tr>                                      <tr>
                                            <td><b>Type</b></td>
                                            <td>
                                            	<label><input type="radio" <?php if($restaurant->rest_type == 'restaurant') echo 'checked="checked"'; ?>  name="rest_type" value="restaurant" />Restaurant </label>
                                                <label><input type="radio" <?php if($restaurant->rest_type == 'store') echo 'checked="checked"'; ?> name="rest_type" value="store" />Store</label>
											</td>
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
                
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Restaurant Logo
                        </div>
                        <div class="panel-body">	
                        	<div class="table-responsive">
                            <?php echo form_open_multipart('panel/restaurant/'.$restaurant->slug.'/edit'); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                <label style="margin-top: 10px;">Restaurant Logo</label>
                                <input type="file" name="logo" size="20" class="form-control" onchange="imageURL(this)" required >
                                <p style="color:#f30;"><small>Images should be 160px x 100px and in jpg or png format!</small></p>
                                    </div>
                                    <div class="col-md-6">
                                    <br>
                                        <img id="preview_img" style="width:160px; height:100px;" />
                                    </div>
                                </div>
                                 <div class="pull-right">
                                	<input type="submit" name="change_logo" class="btn btn-info" value="Change Logo" />
                                </div>
                                </form>
                              </div>
                        </div>
                    </div>
                 </div>
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Restaurant Banner
                        </div>
                        <div class="panel-body">	
                        	<div class="table-responsive">
                            <?php echo form_open_multipart('panel/restaurant/'.$restaurant->slug.'/edit'); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                <label style="margin-top: 10px;">Restaurant Banner</label>
                                <input type="file" name="banner" size="20" class="form-control" onchange="imageURLBanner(this)" required >
                                <p style="color:#f30;"><small>Images should be at least 300px tall and 500px wide and in jpg or png format for best performance!</small></p>
                                    </div>
                                    <div class="col-md-6">
                                    <br>
                                        <img id="preview_img_banner" style="width:375px; height:150px;" />
                                    </div>
                                </div>
                                 <div class="pull-right">
                                	<input type="submit" name="change_banner" class="btn btn-info" value="Change Banner" />
                                </div>
                                </form>
                              </div>
                        </div>
                    </div>
                 </div>
                
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Restaurant Opening Hours
                        </div>
                        <div class="panel-body">
                        	<span style="color:#f30">*Select closed if not open for the day!</span>
                        	<div class="table-responsive">
                            <?php echo form_open('panel/restaurant/'.$restaurant->slug.'/edit'); ?>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                         <tr>
                                                <th>Day</th>
                                                <th>Opening Time</th>
                                                <th>Closing Time</th>
                                                <th>Closed</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$days = array(0,1,2,3,4,5,6,);
										foreach($days as $time)
										{
											$open = "open_".$time;
											$close = "close_".$time;
											$closed = "closed_".$time;
											if(!empty($hours))
											{
												if($hours->$open == "00:00:00" && $hours->$close == "00:00:00")
												{
													echo '
														<tr>
															<td><b>'.$this->rest->dayOfWeek($time).'</b></td>
															<td><input type="time" name="'.$open.'" class="form-control"  /></td>
															<td><input type="time" name="'.$close.'" class="form-control" /></td>
															<td><input type="checkbox" checked name="'.$closed.'"  /></td>
														</tr>
													';
												}
												else {
												echo '
												<tr>
													<td><b>'.$this->rest->dayOfWeek($time).'</b></td>
													<td><input type="time" name="'.$open.'" class="form-control" value="'.$hours->$open.'"  /></td>
													<td><input type="time" name="'.$close.'" class="form-control" value="'.$hours->$close.'" /></td>
													<td><input type="checkbox" name="'.$closed.'"  /></td>
												</tr>
												';
												}
											}
											else {
												echo '
												<tr>
													<td><b>'.$this->rest->dayOfWeek($time).'</b></td>
													<td><input type="time" name="'.$open.'" class="form-control"/></td>
													<td><input type="time" name="'.$close.'" class="form-control"/></td>
													<td><input type="checkbox" name="'.$closed.'"  /></td>
												</tr>
												';
											}
										}
									?>
                                    </tbody>
                                 </table>
                                 <div class="pull-right">
                                	<input type="submit" name="save_hours" class="btn btn-info" value="Save" />
                                </div>
                                </form>
                              </div>
                        </div>
                    </div>
                 </div>
                 
                 <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Restaurant Categories
                        </div>
                        <div class="panel-body">
                        	<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                         <tr>
                                                <th>S/N</th>
                                                <th>Name</th>
                                                <th>Action</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$counter = 1;
										foreach($categories as $item)
										{
											echo '
												<tr>
													<td>'.$counter++.'</td>
													<td>'.$item->cat_name.'</td>
													<td><a href="'.site_url('panel/restaurant/'.$restaurant->slug.'/edit?cat_del='.$item->id).'"><button class="btn btn-info">Delete</button></a></td>
												</tr>
												
											';
										}
									?>
                                    </tbody>
                                 </table>
                            </div>
                            <span style="color:#f30">*Add new categories</span>
                            <div class="table-responsive">
                            	<?php echo form_open('panel/restaurant/'.$restaurant->slug.'/edit'); ?>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                         <tr>
                                                <th>Restaurant</th>
                                                <th>Name</th>
                                            </tr>
                                    </thead>
                                    <tbody id="category">
                                    <tr>
													<td><?php echo $restaurant->rest_name; ?></td>
                                                    <td><input type="text" name="category_name[]" class="form-control" placeholder="Category Name" required></td>
												</tr>
                                    </tbody>
                                 </table>
                            </div>
                            <input type="button" value="Add another category" onClick="addCategory('category');">
                            <div class="pull-right">
                                	<input type="submit" name="add_category" class="btn btn-info" value="Save" />
                                </div>
                             </form>
                         </div>
                     </div>
                  </div>
                 
                 <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Restaurant Menu
                        </div>
                        <div class="panel-body">
                        	<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                         <tr>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										foreach($menu as $item)
										{
											echo '
												<tr>
													<td>'.$item->name.'</td>
													<td>'.$this->rest->getMenuCategoryDetail($item->category, 'cat_name').'</td>
													<td>'.$item->description.'</td>
													<td>₦'.$item->price.'</td>
													<td><a href="'.site_url('panel/restaurant/'.$restaurant->slug.'/edit?item_del='.$item->id).'"><button class="btn btn-info">Delete</button></a></td>
												</tr>
												
											';
										}
									?>
                                    </tbody>
                                 </table>
                            </div>
                            <span style="color:#f30">*Add new menu items below</span>
                            <div class="table-responsive">
                            	<?php echo form_open('panel/restaurant/'.$restaurant->slug.'/edit'); ?>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                         <tr>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                            </tr>
                                    </thead>
                                    <tbody id="menu">
                                    <tr>
													<td><input type="text" name="name[]" class="form-control" placeholder="Menu name" required></td>
                                                    <td>
                                                    	<select class="form-control" name="category[]" required>
                                                        	<?php foreach($categories as $item)
															{
																echo '
																	<option value="'.$item->id.'">'.$item->cat_name.'</option>
																';
															} ?>
                                                        </select>
                                                    </td>
                                                    <td><input type="text" name="description[]" class="form-control" placeholder="Menu Item Description" required></td><td><input type="number" name="price[]" class="form-control" placeholder="Price" required></td>
												</tr>
                                    </tbody>
                                 </table>
                            </div>
                            <input type="button" value="Add another item" onClick="addMenu('menu');">
                            <div class="pull-right">
                                	<input type="submit" name="add_item" class="btn btn-info" value="Save" />
                                </div>
                             </form>
                         </div>
                     </div>
                  </div>
                 
            </div>
                
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
         
         <script type="text/javascript">

	function addMenu(tbodyName){
          var newdiv = document.createElement('tr');
          newdiv.innerHTML = '<td><input type="text" name="name[]" class="form-control" placeholder="Menu name" required></td><td><select class="form-control" name="category[]" required><?php foreach($categories as $item){echo '<option value="'.$item->id.'">'.$item->cat_name.'</option>';}?></select></td><td><input type="text" name="description[]" class="form-control" placeholder="Menu Item Description" required></td><td><input type="number" name="price[]" class="form-control" placeholder="Price" required></td>';
          document.getElementById(tbodyName).appendChild(newdiv);
          
}
		function addCategory(tbodyName){
          var newdiv = document.createElement('tr');
          newdiv.innerHTML = '<td><?php echo $restaurant->rest_name; ?></td><td><input type="text" name="category_name[]" class="form-control" placeholder="Category Name" required></td>';
          document.getElementById(tbodyName).appendChild(newdiv);
          
}	
</script>
  <script type="text/javascript">
    function imageURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_img').attr('src', e.target.result)
                 .width('160px')
                 .height('100px');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
	function imageURLBanner(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_img_banner').attr('src', e.target.result)
                 .width('375px')
                 .height('150px');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>