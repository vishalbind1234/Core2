
<div id="paymentDetails" >
	<?php $paymentMethods = $this->getPaymentMethod(); ?>
	<?php $cart = $this->getCart(); ?>

	<table class="table" >
		<tr>
			<td colspan="4"><label> Payment Method: </label></td>
		</tr>
		<tr>
			<th>Payment ID  </th>
			<th>Payment Name</th>
			<th>Note 		</th>
			<th>Select      </th>
		</tr>
		<?php foreach($paymentMethods as $key => $value) : ?>
			<tr>
				<td class="text-center"> <?php echo $value->id ; ?> </td>
				<td><?php echo $value->name ; ?>  </td>
				<td><?php echo $value->note ; ?>  </td>
				<td><input type="radio" name=Cart[paymentMethod][method] value=<?php echo $value->id ; ?> <?php if($value->id == $cart->paymentMethodId){echo "checked";} ?> ></td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><button type="button" id="save-paymentMethod" value="<?php echo $this->getUrl('savePaymentMethod', 'cart'); ?>" > SAVE </button></td>
		</tr>

	</table>
</div>

<script type="text/javascript">
	

	jQuery("#save-paymentMethod").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.setData(jQuery("#cart-form").serializeArray());
		admin.load();

	});
</script>