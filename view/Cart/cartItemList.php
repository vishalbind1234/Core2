
<?php $cartItems = $this->getCartItem(); ?>

<div id="cart-item-list" >
	<table class="table" >
		<tr>
			<td colspan="2"><label> CartItems &nbsp </label></td>
		</tr>
		<tr>
			<td><button type="button"  onClick="document.getElementById('product-list').style.display='block'" > Add New </button></td>
		</tr>
		<?php $sum = 0; ?>
		<?php if(!$cartItems) : ?>
			<tr>
				<td> No Records . </td>
			</tr>
		<?php else : ?>
			<tr>
				<th>Item-ID</th>
				<th>Cart-ID</th>
				<th>Product-ID</th>
				<th>Product-Name</th>
				<th>Price</th>
				<th>Tax Percentage</th>
				<th>Quantity</th>
				<th>Tax_Amount</th>
				<th>Discount</th>
				<th>Discount_Mode</th>
				<th>Total</th>
			</tr>
			<?php foreach($cartItems as $key => $item) : ?>

				<tr>
					<td> <?php echo $item->id ?> </td>
					<td> <?php echo $item->cartId ?> </td>
					<td> <?php echo $item->productId ?> </td>
					<td> <?php echo $item->productName ?>  </td>
					<td> <?php echo $item->price ?> </td>
					<td> <?php echo $item->taxPercentage . "%" ;?> </td>
					<td> <input type="number" name=Cart[ItemQuantity][<?php echo $item->id; ?>] value="<?php echo $item->quantity ?>"> </td>
					<td> <?php echo $taxAmount = $item->taxAmount ; ?> </td>
					<td> <input type="number" step="0.0001" name="Cart[discountAmount][<?php echo $item->id; ?>]"  value="<?php echo $item->discount; ?>"> </td>

					<td>   
						<select name="Cart[discountMode][<?php echo $item->id; ?>]">
							<option value="<?php echo $item->discountMode; ?>" selected > <?php echo $item->discountMode; ?> </option>
							<option value="fixed"> fixed </option>
							<option value="percentage"> percentage </option>
						</select>
					</td>

					<td><?php echo $total = $item->getFinalPrice(); ?> </td>
					<?php $sum = $sum + $total; ?>
					<td> <button type="button" id="delete-item" value="<?php echo $this->getUrl("deleteItem", 'Cart', ["itemId" => $item->id]); ?>"> Delete </button> </td>
				</tr>
			<?php endforeach ; ?>
		<?php endif; ?>
		<tr>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td>  </td>
			<td> Total : <?php echo $sum ;  ?> </td>
		</tr>
		<tr>
			<td>
				<button type="button" id="save-quantity" value="<?php echo $this->getUrl('saveProductItem', 'Cart'); ?>" > SAVE </button>
			</td>
		</tr>
	</table>
	</div>



<script type="text/javascript">
	
	jQuery("#delete-item").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.setData(jQuery("#cart-form").serializeArray());
		admin.load();

	});


	jQuery("#save-quantity").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.setData(jQuery("#cart-form").serializeArray());
		admin.load();

	});



</script>