<?php if(!($cart = $this->cart)) :  ?>

	<form action="<?php echo $this->getUrl('createCart', 'Cart'); ?>" method="post"  >
		<select name="customerId" onClick="this.form.submit()">
			<?php foreach($this->getCustomers() as $key => $value) : ?>
				<option value="<?php echo $value->id; ?>" > <?php echo $value->firstName; ?> </option>
			<?php endforeach ;  ?>
		</select>
	</form>

<?php else :   ?>

	<?php  $billing = $cart->getBillingAddress();    ?>
	<?php  $shipping = $cart->getShippingAddress();  ?>
	<?php  $cartItem = $cart->getCartItem(); 		 ?>

	<?php $paymentMethod = $cart->getPaymentMethod();     ?>
	<?php $shippingMethod = $cart->getShippingMethod();   ?>
	<?php $cartItems = $cart->getCartItem();   ?>

	<?php 
		$alreadyAdded = [];
		foreach ($cartItems as $key => $value) 
		{
			array_push($alreadyAdded, $value->productId);
		} 
	?>

	<form method="post" >			
		<table>
			<tr>
				<td>
					<table>
						<tr>
							<td colspan="2"><label> Address (Billing) &nbsp </label></td>
							
						</tr>
						<tr>
							<td><label > A_ID &nbsp </label></td>
							<td><input type="number" name=Cart[Address][id] value=<?php echo( $billing->id ); ?>  readonly ></td>
						</tr>
						<tr>
							<td><label > Customer ID &nbsp </label></td>
							<td><input type="number" name=Cart[Address][customerId] value=<?php echo( $cart->customerId ); ?> readonly ></td>
						</tr>
						<tr>
							<td><label > Cart ID &nbsp </label></td>
							<td><input type="number" name=Cart[Address][cartId] value=<?php echo( $cart->id ); ?> readonly ></td>
						</tr>
						<tr>
							<td><label> Address &nbsp </label></td>
							<td><input type="text" name=Cart[Address][address] value=<?php echo( $billing->address ); ?> ></td>
						</tr>
						<tr>
							<td><label> Pincode &nbsp </label></td>
							<td><input type="number" name=Cart[Address][pincode] value=<?php echo( $billing->pincode ); ?> ></td>
						</tr>
						<tr>
							<td><label> City &nbsp </label></td>
							<td><input type="text" name=Cart[Address][city] value=<?php echo( $billing->city ); ?> ></td>
						</tr>
						<tr>
							<td><label> State &nbsp </label></td>
							<td><input type="text" name=Cart[Address][state] value=<?php echo( $billing->state ); ?> ></td>
						</tr>
						<tr>
							<td><label> Country &nbsp </label></td>
							<td><input type="text" name=Cart[Address][country]  value=<?php echo( $billing->country ); ?>  ></td>
						</tr>
						<tr>
							<td><label> Address TYPE &nbsp </label></td>
							<td>
								<input type="text" readonly name=Cart[Address][addressType] value="billing" >
							</td>
						</tr>
						<tr>
							<td><label> Same &nbsp </label></td>
							<td><input type="checkbox" name=Cart[Address][same]  value="1" <?php if( $billing->same == 1 ){echo "checked"; } ?>  ></td>
						</tr>

						<!-- ---------------------------------------------------------------------------------------------------------- -->

						<tr>
							<td><label> FirstName &nbsp </label></td>
							<td><input type="text" name=Cart[Address][firstName]  value=<?php echo( $billing->firstName ); ?>  ></td>
						</tr>
						<tr>
							<td><label> LastName &nbsp </label></td>
							<td><input type="text" name=Cart[Address][lastName]  value=<?php echo( $billing->lastName ); ?>  ></td>
						</tr>
						<tr>
							<td><label> Mobile  &nbsp </label></td>
							<td><input type="text" name=Cart[Address][mobile]  value=<?php echo( $billing->mobile ); ?>  ></td>
						</tr>
						<tr>
							<td><label> Email Address  &nbsp </label></td>
							<td><input type="text" name=Cart[Address][email]  value=<?php echo( $billing->email ); ?>  ></td>
						</tr>

						<tr>
							<td>
								<label> Save To AddressBook. </label>
								<input type="checkbox" name=Cart[Address][saveToAddressBook] value="1" >
							</td>
							<td>
								<label> Mark As Shipping. </label>
								<input type="checkbox" name=Cart[Address][markAsShipping] value="1" <?php if($billing->same == 1){echo "checked";} ?>  >
							</td>
						</tr>

						<tr>
							<td>
								<button type="submit" onClick=this.form.action="<?php echo $this->getUrl('saveBilling'); ?>"; > SAVE </button>
							</td>
						</tr>

					</table>
				</td>

				<td>
					<table>
						<tr>
							<td colspan="2"><label> Shipping Address &nbsp </label></td>
							
						</tr>
						<tr>
							<td><label > A_ID &nbsp </label></td>
							<td><input type="number" name=Cart[ShippingAddress][id] value=<?php echo( $shipping->id ); ?>  readonly ></td>
						</tr>
						<tr>
							<td><label > Customer ID &nbsp </label></td>
							<td><input type="number" name=Cart[ShippingAddress][customerId] value=<?php echo( $cart->customerId ); ?> readonly ></td>
						</tr>
						<tr>
							<td><label > Cart ID &nbsp </label></td>
							<td><input type="number" name=Cart[ShippingAddress][cartId] value=<?php echo( $cart->id ); ?> readonly ></td>
						</tr>
						<tr>
							<td><label> ShippingAddress &nbsp </label></td>
							<td><input type="text" name=Cart[ShippingAddress][address] value=<?php echo( $shipping->address ); ?> ></td>
						</tr>
						<tr>
							<td><label> Pincode &nbsp </label></td>
							<td><input type="number" name=Cart[ShippingAddress][pincode] value=<?php echo( $shipping->pincode ); ?> ></td>
						</tr>
						<tr>
							<td><label> City &nbsp </label></td>
							<td><input type="text" name=Cart[ShippingAddress][city] value=<?php echo( $shipping->city ); ?> ></td>
						</tr>
						<tr>
							<td><label> State &nbsp </label></td>
							<td><input type="text" name=Cart[ShippingAddress][state] value=<?php echo( $shipping->state ); ?> ></td>
						</tr>
						<tr>
							<td><label> Country &nbsp </label></td>
							<td><input type="text" name=Cart[ShippingAddress][country]  value=<?php echo( $shipping->country ); ?>  ></td>
						</tr>

						<tr>
							<td><label> Address TYPE  &nbsp </label></td>
							<td>
								<input type="text" readonly name=Cart[ShippingAddress][addressType] value="shipping"  >
							</td>                                           
						</tr>


						<!-- ------------------------------------------------------------------------------------------------------------- -->
						<tr>
							<td><label> FirstName &nbsp </label></td>
							<td><input type="text" name=Cart[ShippingAddress][firstName]  value=<?php echo( $shipping->firstName ); ?>  ></td>
						</tr>
						<tr>
							<td><label> LastName &nbsp </label></td>
							<td><input type="text" name=Cart[ShippingAddress][lastName]  value=<?php echo( $shipping->lastName ); ?>  ></td>
						</tr>
						<tr>
							<td><label> Mobile  &nbsp </label></td>
							<td><input type="text" name=Cart[ShippingAddress][mobile]  value=<?php echo( $shipping->mobile ); ?>  ></td>
						</tr>
						<tr>
							<td><label> Email &nbsp </label></td>
							<td><input type="text" name=Cart[ShippingAddress][email]  value=<?php echo( $shipping->email ); ?>  ></td>
						</tr>

						<tr>
							<td>
								<label> Save To AddressBook. </label>
								<input type="checkbox" name=Cart[ShippingAddress][saveToAddressBook] value="1" >
							</td>
						</tr>

						<tr>
							<td>
								<button type="submit" onClick=this.form.action="<?php echo $this->getUrl('saveShipping'); ?>"; > SAVE </button>
							</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td>
					<table>
						<?php $paymentMethods = Ccc::getModel("Cart")->getPaymentMethod()->fetchAll("SELECT * FROM Payment_Method"); ?>
						<?php foreach($paymentMethods as $key => $value) : ?>
							<tr>
								<td colspan="2"><label> Payment Method &nbsp </label></td>
							
								<td><label> Payment ID &nbsp </label><input type="number"  readonly   value=<?php echo( $value->id ); ?> ></td>
								<td><label> Payment Name &nbsp </label><input type="text"  readonly   value=<?php echo( $value->name ); ?>  ></td>
								<td><label> Note &nbsp </label><input type="text"  readonly  value=<?php echo( $value->note ); ?>  ></td>
								<td><input type="radio" name=Cart[paymentMethod][method] value=<?php echo( $value->id ); ?> <?php if($value->id == $cart->paymentMethod){echo "checked";} ?> ></td>

							</tr>
						<?php endforeach; ?>
						<tr>
							<td>
								<button type="submit" onClick=this.form.action="<?php echo $this->getUrl('savePaymentMethod'); ?>"; > SAVE </button>
							</td>
						</tr>

					</table>
				</td>

				<td>
					<table>
						<?php $shippingMethods = Ccc::getModel("Cart")->getShippingMethod()->fetchAll("SELECT * FROM Shipping_Method"); ?>
						<?php foreach($shippingMethods as $key => $value) : ?>

							<tr>
								<td colspan="2"><label> Shipping Method &nbsp </label></td>
							
								<td><label> Shipping ID &nbsp </label><input type="number"  readonly   value=<?php echo( $value->id ); ?>   ></td>
								<td><label> Shipping Name &nbsp </label><input type="text"  readonly  value=<?php echo( $value->name ); ?>  ></td>
								<td><label> Amount &nbsp </label><input type="text"  readonly   value=<?php echo( $value->shippingAmount ); ?>  ></td>
								<td><input type="radio" name=Cart[shippingMethod][method] value="<?php echo($value->id."/".$value->shippingAmount); ?>" <?php if($value->id == $cart->shippingMethod){echo "checked";} ?> ></td>

							</tr>
						<?php endforeach; ?>
						<tr>
							<td>
								<button type="submit" onClick=this.form.action="<?php echo $this->getUrl('saveShippingMethod'); ?>"; > SAVE </button>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<table id="product-list" >
						<tr>
							<td><button type="button" onClick="document.getElementById('product-list').style.display='none'" > Cancel </button></td>
						</tr>
						<tr>
							<td><label> Products &nbsp </label></td>
						</tr>
						<?php $products = Ccc::getModel("Product")->fetchAll("SELECT * FROM Product"); ?>
						<?php foreach($products as $key => $product) : ?>
							<?php if(!in_array($product->id, $alreadyAdded)) : ?>
								<tr>
									<td> <label>ProductID &nbsp </label> <?php echo $product->id ?> </td>
									<td> <label>Name &nbsp    </label> <?php echo $product->name ?>  </td>
									<td> <label>Image &nbsp    </label> <image class="img"   src="<?php echo $product->getImageUrl($product->getThum()->image); ?>">  </td>
									<td> <label>Price &nbsp    </label> <?php echo $product->getFinalPrice(); ?> </td>
									<td> <label>Tax Percentage: &nbsp </label>  <?php echo $product->taxPercentage ?> </td>
									<td> <label> Add </label>  <input type="checkbox" name=Cart[ProductGrid][ProductId][] value="<?php echo $product->id; ?>" > </td>
								</tr>
							<?php endif ; ?>
						<?php endforeach ; ?>
						<tr>
							<td>
								<button type="submit" onClick=this.form.action="<?php echo $this->getUrl('addProduct'); ?>"; > SAVE </button>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<table>
						<tr>
							<td colspan="2"><label> CartItems &nbsp </label></td>
						</tr>
						<tr>
							<button type="button" onClick="document.getElementById('product-list').style.display='block'" > Add New </button>
						</tr>
						<?php $sum = 0; ?>
						<?php foreach($cartItems as $key => $item) : ?>
							<tr>
								<td> Item-ID &nbsp <input type="number"  value="<?php echo $item->id ?>"> </td>
								<td> Cart-ID &nbsp <input type="number"  value="<?php echo $cart->id ?>"> </td>
								<td> Product-ID &nbsp <input type="number"  value="<?php echo $item->productId ?>"> </td>
								<td> Product-Name &nbsp <input type="text"  value="<?php echo $item->productName ?>">  </td>
								<td> Price &nbsp <input type="number" value="<?php echo $item->price ?>"> </td>
								<td> Tax_Percentage: &nbsp <?php echo $item->taxPercentage . "%" ;?>  </td>
								<td> Quantity &nbsp <input type="number" name=Cart[productItem][Item][<?php echo $item->id; ?>] value="<?php echo $item->quantity ?>"> </td>
								<td> Tax_Amount: &nbsp <?php echo $taxAmount = $item->taxAmount ; ?> </td>
								<td> Discount &nbsp <input type="number" step="0.0001" name="Cart[discountAmount][<?php echo $item->id; ?>]"  value="<?php echo $item->discount; ?>"> </td>

								<td> Discount_Mode: &nbsp  
									<select name="Cart[discountMode][<?php echo $item->id; ?>]">
										<option value="<?php echo $item->discountMode; ?>" selected > <?php echo $item->discountMode; ?> </option>
										<option value="fixed"> fixed </option>
										<option value="percentage"> percentage </option>
									</select>
								</td>

								<td> Total &nbsp <input type="number" value="<?php echo $total = $item->getFinalPrice(); ?>"> </td>
								<?php $sum = $sum + $total; ?>
								<td> <a href="<?php echo $this->getUrl("deleteItem", null, ["id" => $item->id]); ?>"> Delete </a> </td>
							</tr>
						<?php endforeach ; ?>
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
							<td> Total &nbsp <input type="number" value="<?php echo $sum ;  ?>"> </td>
						</tr>
						<tr>
							<td>
								<button type="submit" onClick=this.form.action="<?php echo $this->getUrl('saveProductItem'); ?>"; > SAVE </button>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<table>
						<tr> <td colspan="2"><label> CartDetails &nbsp </label></td> </tr>
						<tr> <td> Cart-ID &nbsp <input type="number" name=Cart[cartSummary][cartId]  value="<?php echo $cart->id ?>"> </td> </tr>
						<tr> <td> Total &nbsp <input type="number" name=Cart[cartSummary][cartTotal] value="<?php echo $cart->cartTotal ?>"> </td> </tr>
						<tr> <td> Discount &nbsp <input type="number" name=Cart[cartSummary][discount] value="<?php echo $cart->discount  ?>">  </td> </tr>
						<tr> <td> Shipping Charge &nbsp <input type="number" name=Cart[cartSummary][shippingCharges] value="<?php echo $cart->shippingCharge ;?>"> </td> </tr>
						<tr> <td> Grand Total &nbsp <input type="number" name=Cart[cartSummary][grandTotal] value="<?php echo ($cart->cartTotal + $cart->shippingCharge) ;?>"> </td> </tr>
					</table>
				</td>
			</tr>
		</table>
		<button type="submit" onClick=this.form.action="<?php echo $this->getUrl('placeOrder'); ?>"; > Place Order </button>
	</form>
<br>
<a href="<?php echo $this->getUrl("grid","Customer"); ?>"><button type="button">Back</button></a>


<?php endif ;  ?>


