<div class="container no-center block">
            <div class="row">
            	<div class="col-md-8">
                	<h2>Add New Restaurant</h2>
                    	<span style="color:#f30;"><small>* All fields are required!</small></span>
                        <?php echo validation_errors(); ?>
					   <?php echo form_open_multipart('add-restaurant'); ?>
                        <div class="row">
                            <div class="col-md-6">
                                <label style="margin-top: 10px;">Restaurant Name</label>
                                <input type="text" name="name" required="required" class="form-control" placeholder="e.g Ace's Restaurant" />
                            </div>
                            <div class="col-md-6">
                                <label style="margin-top: 10px;">Restaurant Address</label>
                                <input type="text" name="address" required="required" class="form-control" placeholder="e.g 5, Hainat Augusto Crescent" />
                            </div>
                        </div>
                        <div class="row">	
                        	<div class="col-md-3">
                            	<label style="margin-top: 10px;">Restaurant City</label>
                                <input type="text" name="city" required="required" class="form-control" placeholder="e.g Ilorin" />
                            </div>
                            <div class="col-md-3">
                            	<label style="margin-top: 10px;">Restaurant State</label>
                                    <select class="form-control" name="state">
                                        <?php foreach($states as $state) {
                                            echo "<option value='".$state->name."'>".$state->name."</option>";
                                        }
                                        ?>
                                    </select>
                            </div>
                            <div class="col-md-6">
                            	<label style="margin-top: 10px;">Restaurant Email</label>
                                <input type="email" name="rest_email" required="required" class="form-control" placeholder="e.g info@acerestaurant.com"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label style="margin-top: 10px;">Contact Person's Name</label>
                                <input type="text" required="required" name="contact_person" class="form-control" placeholder="e.g Punctual Delivery!">
                            </div>
                            <div class="col-md-6">
                                   <label style="margin-top: 10px;">Restaurant Phone No</label>
                                <input type="text" required="required" name="phone_no" class="form-control" placeholder="e.g 070xxxxxxxx">
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                          <label style="margin-top: 10px;">Cuisines</label>
                          <input type="text" required="required" name="cuisines" class="form-control" placeholder="Separate with comma e.g Nigerian, Salad, Burgers">
                        </div>
                        <div class="col-md-6">
                        	<label style="margin-top: 10px;">Your Email</label>
                          <input type="email" required="required" name="y_email" class="form-control" placeholder="user@gmail.com">
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                        <label style="margin-top: 10px;">Restaurant Logo</label>
                        <input type="file" name="logo" size="20" class="form-control" onchange="imageURL(this)" >
                        <p style="color:#f30;"><small>Images should be 160px x 100px and in jpg or png format!</small></p>
                        	</div>
                            <div class="col-md-6">
                            <br>
                                <img id="preview_img" style="width:160px; height:100px;" />
                            </div>
                        </div>
                       
                       
                       <div class="row"></div>
                       <input name="review-submit" type="submit" class="btn btn-primary" value="Submit Restaurant" style="margin-top: 10px;"> 
                       </form>
               </div>
                        
                <div class="col-md-4">
                        <h4>FAQs</h4>
                        <dl>
                        	<dt>Q: Is there another way to add restaurants?</dt>
                            	<dd>A: Yes, send an email to support@mealdeal.com.ng with all the data</dd>
                            <dt>Q: Is it free to list a restaurant?</dt>
                            	<dd>A: Yes, listing a restaurant on our website is completely free.</dd>
                            <dt>Q: Can I list a restaurant that is not mine?</dt>
                            	<dd>A: Yes, you can list any restaurant with correct information.</dd>
                            <dt>Q: Is it free to list a restaurant?</dt>
                            	<dd>A: Yes, listing a restaurant on our website is completely free.</dd>
                            <dt>Q: Is it just restaurants?</dt>
                            	<dd>A: No, Any thing that has to do with food - joints, stands and eateries and offer delivery.</dd>
                 </div>
            </div>
                
 </div>
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