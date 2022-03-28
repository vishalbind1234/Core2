
<?php   $customer = $this->getCurrentCustomer();     /* echo "<pre>"; print_r($customer);  exit();*/ ?>"
<?php   $billing = $customer->getBillingAddress();   /* echo "<pre>"; print_r($billing);  exit();*/  ?>"
<?php   $shipping = $customer->getShippingAddress(); /* echo "<pre>"; print_r($shipping);  exit();*/ ?>"

<script type="text/javascript">

	/*document.onreadystatechange = function()
	{
		if(document.readyState === 'complete')
		{
			showShipping();
		}
	}

	function showShipping()
	{
		var form = document.getElementById("shipping");
		var ckbox = document.getElementById("same");
		if(ckbox.checked == true)
		{
			form.style.display = "none";
		}
		else
		{
			form.style.display = "block";	
		}
	}*/

	function showShipping()
	{
		if($("#same").attr('checked')
		{
			$("#shipping").hide();
		}
		else
		{
			$("#shipping").show();
		}
	}

	$(document).ready(function(){

		$("#same").click(showShipping());

	});
	
</script>



<form action="<?php echo($this->getUrl('save' , 'Customer' )); ?>" method="post">


	<table>

		<tr>
			<td colspan="2"><label> Person &nbsp </label></td>
			
		</tr>

		<tr>
			<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
			<td><input type="number" name=Person[id] value="<?php echo( $customer->id ); ?>"  readonly ></td>
		</tr>
		<tr>
			<td><label> First Name &nbsp </label></td>
			<td><input type="text" name=Person[firstName]  value="<?php echo( $customer->firstName ); ?>"   ></td>
		</tr>
		<tr>
			<td><label> Last Name &nbsp </label></td>
			<td><input type="text" name=Person[lastName]  value="<?php echo( $customer->lastName ); ?>"   ></td>
		</tr>
		<tr>
			<td><label> Email &nbsp </label></td>
			<td><input type="text" name=Person[email]  value="<?php echo( $customer->email ); ?>"   ></td>
		</tr>
		<tr>
			<td><label> Mobile &nbsp </label></td>
			<td><input type="number" name=Person[mobile]  value="<?php echo( $customer->mobile ); ?>"   ></td>
		</tr>
		<tr>
			<td><label> CreatedAt &nbsp </label></td>
			<td><input type="date" name=Person[createdAt]  value="<?php echo( $customer->createdAt ); ?>"   ></td>
		</tr>
		<tr>
			<td><label> UpdatedAt &nbsp </label></td>
			<td><input type="date" name=Person[updatedAt]  value=""  hidden ></td> 
		</tr>
		<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

		<tr>
			<td colspan="2"><label> Address (Billing) &nbsp </label></td>
			
		</tr>
		<tr>
			<td><label > A_ID &nbsp </label></td>
			<td><input type="number" name=Address[id] value="<?php echo( $billing->id ); ?>"  readonly ></td>
		</tr>
		<tr>
			<td><label > Customer ID &nbsp </label></td>
			<td><input type="number" name=Address[customerId] value="<?php echo( $customer->id ); ?>" readonly ></td>
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
			<td>
				<input type="text" readonly name=Address[addressType] value="billing" >
			</td>
		</tr>

		<tr>
			<td><label> Same As Billing Address &nbsp </label></td>
			<td><input type="checkbox" id="same" name=Address[same]  value="1" <?php if($billing->same == 1){echo 'checked' ;} ?>"  onClick=showShipping() ></td>
		</tr>

		<!-- ---------------------------------------------------------------------------------------------------------------------------------------- -->
		<table id="shipping" >
			<tr>
				<td colspan="2"><label> Shipping Address &nbsp </label></td>
				
			</tr>
			<tr>
				<td><label > A_ID &nbsp </label></td>
				<td><input type="number" name=ShippingAddress[id] value="<?php echo( $shipping->id ); ?>"  readonly ></td>
			</tr>
			<tr>
				<td><label > Customer ID &nbsp </label></td>
				<td><input type="number" name=ShippingAddress[customerId] value="<?php echo( $customer->id ); ?>" readonly ></td>
			</tr>
			<tr>
				<td><label> ShippingAddress &nbsp </label></td>
				<td><input type="text" name=ShippingAddress[address] value="<?php echo $shipping->address; ?>" ></td>
			</tr>
			<tr>
				<td><label> Pincode &nbsp </label></td>
				<td><input type="number" name=ShippingAddress[pincode] value="<?php echo($shipping->pincode ); ?>" ></td>
			</tr>
			<tr>
				<td><label> City &nbsp </label></td>
				<td><input type="text" name=ShippingAddress[city] value="<?php echo( $shipping->city ); ?>" ></td>
			</tr>
			<tr>
				<td><label> State &nbsp </label></td>
				<td><input type="text" name=ShippingAddress[state] value="<?php echo( $shipping->state ); ?>" ></td>
			</tr>
			<tr>
				<td><label> Country &nbsp </label></td>
				<td><input type="text" name=ShippingAddress[country]  value="<?php echo( $shipping->country ); ?>"  ></td>
			</tr>

			<tr>
				<td><label> Address TYPE  &nbsp </label></td>
				<td>
					<input type="text" readonly name=ShippingAddress[addressType] value="shipping"  >
				</td>                                           
			</tr>
			
		</table>
			
					
		</tbody>
		<tfoot>
			<tr><td><input type="submit"></td></tr>
		</tfoot>
						
	</table>

</form>

		
