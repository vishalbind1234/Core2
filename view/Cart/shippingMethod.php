
<div id="shippingDetails" >
	<?php $shippingMethods = $this->getShippingMethod(); ?>
	<?php $cart = $this->getCart(); ?>
	
	<table class="table" >
		<tr>
			<td colspan="4"><label> Shipping Method: </label></td>
		</tr>
		<tr>
			<th>Shipping ID  </th>
			<th>Shipping Name</th>
			<th>Amount 		</th>
			<th>Select      </th>
		</tr>
		<?php foreach($shippingMethods as $key => $value) : ?>
			<tr>
				<td class="text-center"><?php echo $value->id ; ?> </td>
				<td><?php echo $value->name ; ?> </td>
				<td><?php echo $value->shippingAmount ; ?> </td>
				<td><input type="radio" name=Cart[shippingMethod][method] value="<?php echo($value->id."/".$value->shippingAmount); ?>" <?php if($value->id == $cart->shippingMethodId){echo "checked";} ?> ></td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><button type="button" id="save-shippingMethod" value="<?php echo $this->getUrl('saveShippingMethod', 'Cart'); ?>" > SAVE </button></td>
		</tr>
	</table>
</div>


<script type="text/javascript">
	


	jQuery("#save-shippingMethod").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.setData(jQuery("#cart-form").serializeArray());
		admin.load();

	});



</script>