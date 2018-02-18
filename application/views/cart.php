<ul class="products">
    <?php foreach($products as $p): ?>
    <li>
        <h3><?php echo $p['name']; ?></h3>
        <small>&euro;<?php echo $p['price']; ?></small>
        <?php echo form_open('cart/add_cart_item'); ?>
            <fieldset>
                <label>Quantity</label>
                <?php echo form_input('quantity', '1', 'maxlength="2"'); ?>
                <?php echo form_hidden('product_id', $p['id']); ?>
                <?php echo form_submit('add', 'Add'); ?>
            </fieldset>
        <?php echo form_close(); ?>
    </li>
    <?php endforeach;?>
</ul>
<div class="cart_list">
        <h3>Your shopping cart</h3>
        <div id="cart_content">
            <?php if(!$this->cart->contents()):
				echo 'You don\'t have any items yet.';
			else:
			?>
			 
			<?php echo form_open('cart/update_cart'); ?>
			<table width="100%" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<td>Qty</td>
						<td>Item Description</td>
						<td>Item Price</td>
						<td>Sub-Total</td>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1; ?>
					<?php foreach($this->cart->contents() as $items): ?>
					 
					<?php echo form_hidden('rowid[]', $items['rowid']); ?>
					<tr <?php if($i&1){ echo 'class="alt"'; }?>>
						<td>
							<?php echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?>
						</td>
						 
						<td><?php echo $items['name']; ?></td>
						 
						<td>&euro;<?php echo $this->cart->format_number($items['price']); ?></td>
						<td>&euro;<?php echo $this->cart->format_number($items['subtotal']); ?></td>
					</tr>
					 
					<?php $i++; ?>
					<?php endforeach; ?>
					 
					<tr>
						<td</td>
						<td></td>
						<td><strong>Total</strong></td>
						<td>&euro;<?php echo $this->cart->format_number($this->cart->total()); ?></td>
					</tr>
				</tbody>
			</table>
			 
			<p><?php echo form_submit('', 'Update your Cart'); echo anchor('cart/empty_cart', 'Empty Cart', 'class="empty"');?></p>
			<p><small>If the quantity is set to zero, the item will be removed from the cart.</small></p>
			<?php 
			echo form_close(); 
			endif;
			?>
        </div>
    </div>
<script>
	$(document).ready(function() { 
		/*place jQuery actions here*/ 
		var link = "/tutorials/CodeIgniter_Shopping_Cart/demo/index.php/"; // Url to your application (including index.php/)
	
		$("ul.products form").submit(function() {
			// Get the product ID and the quantity 
			var id = $(this).find('input[name=product_id]').val();
			var qty = $(this).find('input[name=quantity]').val();
			
			$.post('<?php echo site_url('cart/add_cart_item'); ?>', { product_id: id, quantity: qty, ajax: '1' },
  				function(data){	
 		 			if(data == 'true'){
 		 			
    					$.get('<?php echo site_url('cart/show_cart'); ?>', function(cart){ // Get the contents of the url cart/show_cart
  							$("#cart_content").html(cart); // Replace the information in the div #cart_content with the retrieved data
						}); 		 
										
 		 			}else{
 		 				alert("Product does not exist");
 		 			}
					console.log(data);
 			 });
			
			return false; // Stop the browser of loading the page defined in the form "action" parameter.
		});
	
	});
	$(".empty").on("click", function(){
    	$.get('<?php echo site_url('cart/empty_cart'); ?>', function(){
    		$.get('<?php echo site_url('cart/show_cart'); ?>', function(cart){
  				$("#cart_content").html(cart);
			});
		});
		
		return false;
    });
</script>