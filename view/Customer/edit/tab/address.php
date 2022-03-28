
<?php   $customer = $this->getCurrentCustomer(); /*echo "<pre>";  print_r($customer);  exit();*/  ?>
<?php   $billing = $customer->getBillingAddress(); ?>
<?php   $shipping = $customer->getShippingAddress(); ?>

<script type="text/javascript">

	function showShipping()
	{
		if($('#same').is(':checked'))
		{
			$(".shipping").hide();
		}
		else
		{
			$(".shipping").show();
		}
	}

	$(document).ready(function(){

		showShipping();
		$("#same").click(function(){
			showShipping();
		});

	});
	
</script>

<table>
	
	<tr>
		<td colspan="2"><label> Address (Billing) &nbsp </label></td>
	</tr>
	<tr>
		<td><label > A_ID &nbsp </label></td>
		<td><input type="number" name=Address[id] value="<?php echo( $billing->id ); ?>"  readonly ></td>
	</tr>
	<tr>
		<td><label > Customer ID &nbsp </label></td>
		<td><input type="number" name=Address[customerId] value="<?php echo( $billing->customerId ); ?>" readonly ></td>
	</tr>
	<tr>
		<td><label> Address &nbsp </label></td>
		<td><input type="text" name=Address[address] value="<?php echo $billing->address; ?>" ></td>
	</tr>
	<tr>
		<td><label> Pincode &nbsp </label></td>
		<td><input type="number" name=Address[pincode] value="<?php echo( $billing->pincode ); ?>" ></td>
	</tr>
	<tr>
		<td><label> City &nbsp </label></td>
		<td><input type="text" name=Address[city] value="<?php echo( $billing->city ); ?>" ></td>
	</tr>
	<tr>
		<td><label> State &nbsp </label></td>
		<td><input type="text" name=Address[state] value="<?php echo( $billing->state ); ?>" ></td>
	</tr>
	<tr>
		<td><label> Country &nbsp </label></td>
		<td><input type="text" name=Address[country]  value="<?php echo ($billing->country); ?>"  ></td>
	</tr>
	<tr>
		<td><label> Address TYPE &nbsp </label></td>
		<td><input type="text" readonly name=Address[addressType] value="billing" ></td>
	</tr>

	<tr>
		<td><label> Same As Billing Address &nbsp </label></td>
		<td><input type="checkbox" id="same" name=Address[same]  value="1" <?php if($billing->same == 1){echo 'checked' ;} ?> ></td>
	</tr>
	<!-- ------------------------------------------------------------------------------------------------------------------------ -->
	<tr class="shipping">
		<td colspan="2"><label> Shipping Address &nbsp </label></td>
	</tr>
	<tr class="shipping">
		<td><label > A_ID &nbsp </label></td>
		<td><input type="number" name=ShippingAddress[id] value="<?php echo( $shipping->id ); ?>"  readonly ></td>
	</tr>
	<tr class="shipping">
		<td><label > Customer ID &nbsp </label></td>
		<td><input type="number" name=ShippingAddress[customerId] value="<?php echo( $shipping->customerId ); ?>" readonly ></td>
	</tr>
	<tr class="shipping">
		<td><label> ShippingAddress &nbsp </label></td>
		<td><input type="text" name=ShippingAddress[address] value="<?php echo $shipping->address; ?>" ></td>
	</tr>
	<tr class="shipping">
		<td><label> Pincode &nbsp </label></td>
		<td><input type="number" name=ShippingAddress[pincode] value="<?php echo($shipping->pincode ); ?>" ></td>
	</tr>
	<tr class="shipping">
		<td><label> City &nbsp </label></td>
		<td><input type="text" name=ShippingAddress[city] value="<?php echo( $shipping->city ); ?>" ></td>
	</tr>
	<tr class="shipping">
		<td><label> State &nbsp </label></td>
		<td><input type="text" name=ShippingAddress[state] value="<?php echo( $shipping->state ); ?>" ></td>
	</tr>
	<tr class="shipping">
		<td><label> Country &nbsp </label></td>
		<td><input type="text" name=ShippingAddress[country]  value="<?php echo( $shipping->country ); ?>"  ></td>
	</tr>

	<tr class="shipping">
		<td><label> Address TYPE  &nbsp </label></td>
		<td><input type="text" readonly name=ShippingAddress[addressType] value="shipping" ></td>                                           
	</tr>
	<!-- --------------------------------------------------------------------------------------------------------------------- -->
	<tr>
		<td> <button type="submit"> Save & Continue </button> </td>
	</tr>
	<tr>
		<td> <a href="<?php echo $this->getUrl('grid', 'Customer'); ?>"><button type="button"> Back To Grid </button></a> </td>
	</tr>

</table>


	
	
