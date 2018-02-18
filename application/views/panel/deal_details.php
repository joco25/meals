<div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Deal - <?php echo $deal->id; ?></h2>  
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
                             Deal Details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                            <?php echo form_open('panel/deals/edit/'.$deal->id); ?>
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
                                            <td><?php echo $this->rest->getRestDetail($deal->rest_id, 'rest_name').'<br/> <small>'.$this->rest->getRestDetail($deal->rest_id, 'rest_address').', '.$this->rest->getRestDetail($deal->rest_id, 'rest_city').' '.$this->rest->getRestDetail($deal->rest_id, 'rest_state'); ?><br> <?php echo $this->rest->getRestDetail($deal->rest_id, 'phone_no'). '</small>'?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Percent</b></td>
                                            <td><input type="number" class="form-control" name="percent" required="required" value="<?php echo $deal->percent; ?>" /></td>
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
         
         <script type="text/javascript">

	function addMenu(tbodyName){
          var newdiv = document.createElement('tr');
          newdiv.innerHTML = '<td><input type="text" name="name[]" class="form-control" placeholder="Menu name" required></td><td><input type="text" name="description[]" class="form-control" placeholder="Menu Item Description" required></td><td><input type="number" name="price[]" class="form-control" placeholder="Price" required></td>';
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
</script>