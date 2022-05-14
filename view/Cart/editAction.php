<!DOCTYPE html>
<html>

	<?php echo Ccc::getBlock("Core_Layout_Head")->toHtml(); ?>

<body class="table" >

	<div id="cart-index" >
		<?php $cart = $this->getCart(); ?>
		<?php if($cart->id == null) :  ?>

			<form id="add-new-cart" action="<?php echo $this->getUrl('createCart', 'Cart'); ?>" method="post" >
				<select id="select-customer" name="customerId" >
					<?php foreach($this->getCustomers() as $key => $value) : ?>
						<option value="<?php echo $value->id; ?>" > <?php echo $value->firstName; ?> </option>
					<?php endforeach ;  ?>
				</select>
			</form>

		<?php else :   ?>
		<form id="cart-form">

			<?php  $customer = $cart->getCustomer(); 		 ?>
			<?php  $billing = $cart->getBillingAddress();    ?>
			<?php  $shipping = $cart->getShippingAddress();  ?>

			<?php $paymentMethod = $cart->getPaymentMethod();     ?>
			<?php $shippingMethod = $cart->getShippingMethod();   ?>
			<?php $cartItems = $cart->getCartItem();  			  ?>

			<?php $products = Ccc::getModel("Product")->fetchAll("SELECT * FROM Product"); ?>
			<?php 
				$alreadyAdded = [];
				foreach ($cartItems as $key => $value) 
				{
					array_push($alreadyAdded, $value->productId);
				} 
			?>

			<form id="cart-form" method="post" >			
						
				<table class="table" >
					<tr>
						<td>
							<table class="table" >
								<tr>
									<td colspan="2"><label> Customer Information : </label></td>
									
								</tr>
								<tr>
									<td><label > Cart ID &nbsp </label></td>
									<td><input type="number" name=Cart[CustomerInfo][cartId]  readonly value=<?php echo $cart->id ; ?> ></td>
								</tr>
								<tr>
									<td><label> FirstName &nbsp </label></td>
									<td><input type="text" name=Cart[CustomerInfo][firstName]  value=<?php echo $customer->firstName ; ?>  ></td>
								</tr>
								<tr>
									<td><label> LastName &nbsp </label></td>
									<td><input type="text" name=Cart[CustomerInfo][lastName]  value=<?php echo $customer->lastName ; ?>  ></td>
								</tr>
								<tr>
									<td><label> Mobile  &nbsp </label></td>
									<td><input type="text" name=Cart[CustomerInfo][mobile]  value=<?php echo $customer->mobile ; ?>  ></td>
								</tr>
								<tr>
									<td><label> Email Addresss  &nbsp </label></td>
									<td><input type="text" name=Cart[CustomerInfo][email]  value=<?php echo $customer->email ; ?>  ></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table class="table" >
								
								<!-- --------------------------------------------------------------------------------------------------------------------------------------- -->
								<tr>
									<td colspan="2"><label> Address (Billing) : </label></td>
								</tr>
								<tr>
									<td><label > A_ID &nbsp </label></td>
									<td><input type="number" name=Cart[Billing][BillingAddress][addressId] <?php if(!$billing->addressId){echo "hidden";} ?> readonly value=<?php echo $billing->addressId ; ?>  ></td>
								</tr>
								<tr>
									<td><label > Customer ID &nbsp </label></td>
									<td><input type="number" name=Cart[Billing][BillingAddress][customerId]  readonly value=<?php echo $cart->customerId ; ?>  ></td>
								</tr>
								<tr>
									<td><label> Address &nbsp </label></td>
									<td><input type="text" name=Cart[Billing][BillingAddress][address] value=<?php echo $billing->address ; ?> ></td>
								</tr>
								<tr>
									<td><label> Pincode &nbsp </label></td>
									<td><input type="number" name=Cart[Billing][BillingAddress][pincode] value=<?php echo $billing->pincode ; ?> ></td>
								</tr>
								<tr>
									<td><label> City &nbsp </label></td>
									<td><input type="text" name=Cart[Billing][BillingAddress][city] value=<?php echo $billing->city ; ?> ></td>
								</tr>
								<tr>
									<td><label> State &nbsp </label></td>
									<td><input type="text" name=Cart[Billing][BillingAddress][state] value=<?php echo $billing->state ; ?> ></td>
								</tr>
								<tr>
									<td><label> Country &nbsp </label></td>
									<td><input type="text" name=Cart[Billing][BillingAddress][country]  value=<?php echo $billing->country ; ?>  ></td>
								</tr>
								<tr>
									<td><label> Same &nbsp </label></td>
									<td><input type="checkbox" name=Cart[Billing][BillingAddress][same]  value="1" <?php if($billing->same == 1){echo "checked"; } ?>  ></td>
								</tr>
								<tr>
									<td><label> Address TYPE &nbsp </label></td>
									<td>
										<input type="text" readonly name=Cart[Billing][BillingAddress][addressType] value="billing" >
									</td>
								</tr>
								<!-- ---------------------------------------------------------------------------------------------------------- -->
								<tr>
									<td><label> Save To AddressBook. </label></td>
									<td><input type="checkbox" name=Cart[Billing][saveToAddressBook] value="1" ></td>
								</tr>
								<tr>
									<td><label> Mark As Shipping. </label></td>
									<td><input type="checkbox" name=Cart[Billing][markAsShipping] value="1" <?php if($billing->same == 1){echo "checked";} ?> ></td>
								</tr>
								<tr>
									<td><button type="button" id="save-billing"  value="<?php echo $this->getUrl('saveBilling', 'Cart'); ?>" > SAVE </button></td>
								</tr>

							</table>
						</td>

						<td>
							<table class="table" >
								<tr>
									<td colspan="2"><label> Shipping Address : </label></td>
								</tr>
								<tr>
									<td><label > A_ID &nbsp </label></td>
									<td><input type="number" name=Cart[Shipping][ShippingAddress][addressId] <?php if(!$shipping->addressId){echo "hidden";} ?> readonly value=<?php echo $shipping->addressId ; ?>  readonly ></td>
								</tr>
								<tr>
									<td><label > Customer ID &nbsp </label></td>
									<td><input type="number" name=Cart[Shipping][ShippingAddress][customerId] readonly value=<?php echo $cart->customerId ; ?> ></td>
								</tr>
								<tr>
									<td><label> ShippingAddress &nbsp </label></td>
									<td><input type="text" name=Cart[Shipping][ShippingAddress][address] value=<?php echo $shipping->address ; ?> ></td>
								</tr>
								<tr>
									<td><label> Pincode &nbsp </label></td>
									<td><input type="number" name=Cart[Shipping][ShippingAddress][pincode] value=<?php echo $shipping->pincode ; ?> ></td>
								</tr>
								<tr>
									<td><label> City &nbsp </label></td>
									<td><input type="text" name=Cart[Shipping][ShippingAddress][city] value=<?php echo $shipping->city ; ?> ></td>
								</tr>
								<tr>
									<td><label> State &nbsp </label></td>
									<td><input type="text" name=Cart[Shipping][ShippingAddress][state] value=<?php echo $shipping->state ; ?> ></td>
								</tr>
								<tr>
									<td><label> Country &nbsp </label></td>
									<td><input type="text" name=Cart[Shipping][ShippingAddress][country]  value=<?php echo $shipping->country ; ?>  ></td>
								</tr>
								<tr>
									<td><label> Address TYPE  &nbsp </label></td>
									<td>
										<input type="text" readonly name=Cart[Shipping][ShippingAddress][addressType] value="shipping"  >
									</td>                                           
								</tr>
								<!-- ------------------------------------------------------------------------------------------------------------- -->
								<tr>
									<td><label> Save To AddressBook. </label></td>
									<td><input type="checkbox" name=Cart[Shipping][saveToAddressBook] value="1" ></td>
								</tr>

								<tr>
									<td><button type="button" id="save-shipping" value="<?php echo $this->getUrl('saveShipping', 'Cart'); ?>" > SAVE </button></td>
								</tr>
							</table>
						</td>
					</tr>

					<tr>
						<td>
							<div id="paymentDetails" >

								<?php echo Ccc::getBlock("Cart_PaymentMethod")->toHtml(); ?>

							</div>
						</td>

						<td>
							<div id="shippingDetails" >

								<?php echo Ccc::getBlock("Cart_ShippingMethod")->toHtml(); ?>

							</div>
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<div id="product-list" class="row-lg-12" >

								<?php echo Ccc::getBlock("Cart_ProductList")->toHtml(); ?>
							
							</div>
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<div id="cart-item-list" >
							
								<?php echo Ccc::getBlock("Cart_CartItemList")->toHtml(); ?>

							</div>
						</td>
					</tr>

					<tr>
						<td colspan="2">
							<div id=cart-summary >
							  
								<?php echo Ccc::getBlock("Cart_CartSummary")->toHtml(); ?>

							</div>
						</td>
					</tr>
				</table>
				<button type="button" id="place-order" value="<?php echo $this->getUrl('placeOrder', 'Cart'); ?>" > Place Order </button>
			</form>
		<br>
		<a href="<?php echo $this->getUrl("grid","Cart"); ?>"><button type="button">Back</button></a>

		</form>
		<?php endif ;  ?>
		
	</div>

</body>
</html>



<script type="text/javascript">
	
	jQuery("#select-customer").click(function(){

		admin.setUrl(jQuery("#add-new-cart").attr("action"));
		admin.setData(jQuery("#add-new-cart").serializeArray());
		admin.load();

	});

	jQuery("#save-billing").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.setData(jQuery("#cart-form").serializeArray());
		admin.load();

	});

	jQuery("#save-shipping").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.setData(jQuery("#cart-form").serializeArray());
		admin.load();

	});

	jQuery("#place-order").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.setData(jQuery("#cart-form").serializeArray());
		admin.load();

	});



</script>

<?php echo Ccc::getBlock("Core_Layout_Footer")->toHtml(); ?>