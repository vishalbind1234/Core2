
	<?php $order = $this->getOrderDetails() ;  /*echo "<pre>";  print_r($order); exit();*/ ?>

	<?php  $billing = $order->getBillingAddress();    ?>
	<?php  $shipping = $order->getShippingAddress();  ?>
	<?php  $orderItem = $order->getOrderItem(); 		 ?>

	<?php $paymentMethod = $order->getPaymentMethod();     ?>
	<?php $shippingMethod = $order->getShippingMethod();   ?>

		
		<table>
			<tr>
				<td>
					<table>
						<tr>
							<td colspan="2"><label> Address (Billing) &nbsp </label></td>
						</tr>

						<tr>
							<td><label> FirstName &nbsp </label></td>
							<td> <?php echo( $billing->firstName ); ?> </td>
						</tr>
						<tr>
							<td><label> LastName &nbsp </label></td>
							<td> <?php echo( $billing->lastName ); ?> </td>
						</tr>
						<tr>
							<td><label> Mobile  &nbsp </label></td>
							<td> <?php echo( $billing->mobile ); ?> </td>
						</tr>
						<tr>
							<td><label> Email Address  &nbsp </label></td>
							<td> <?php echo( $billing->email ); ?> </td>
						</tr>
						<!-- ---------------------------------------------------------------------------------------------------- -->

						<tr>
							<td><label > A_ID &nbsp </label></td>
							<td> <?php echo( $billing->id ); ?> </td>
						</tr>
						<tr>
							<td><label > Customer ID &nbsp </label></td>
							<td> <?php echo( $order->customerId ); ?> </td>
						</tr>
						<tr>
							<td><label > Order ID &nbsp </label></td>
							<td> <?php echo( $order->id ); ?> </td>
						</tr>
						<tr>
							<td><label> Address &nbsp </label></td>
							<td> <?php echo( $billing->address ); ?> </td>
						</tr>
						<tr>
							<td><label> Pincode &nbsp </label></td>
							<td> <?php echo( $billing->pincode ); ?> </td>
						</tr>
						<tr>
							<td><label> City &nbsp </label></td>
							<td> <?php echo( $billing->city ); ?> </td>
						</tr>
						<tr>
							<td><label> State &nbsp </label></td>
							<td> <?php echo( $billing->state ); ?> </td>
						</tr>
						<tr>
							<td><label> Country &nbsp </label></td>
							<td> <?php echo( $billing->country ); ?> </td>
						</tr>
						<tr>
							<td><label> Address TYPE &nbsp </label></td>
							<td>  <?php echo( $billing->addressType ); ?> </td>
						</tr>

					</table>
				</td>

				<td>
					<table>
						<tr>
							<td colspan="2"><label> Shipping Address &nbsp </label></td>
						</tr>

						<tr>
							<td><label> FirstName &nbsp </label></td>
							<td> <?php echo( $shipping->firstName ); ?> </td>
						</tr>
						<tr>
							<td><label> LastName &nbsp </label></td>
							<td> <?php echo( $shipping->lastName ); ?> </td>
						</tr>
						<tr>
							<td><label> Mobile  &nbsp </label></td>
							<td> <?php echo( $shipping->mobile ); ?> </td>
						</tr>
						<tr>
							<td><label> Email &nbsp </label></td>
							<td> <?php echo( $shipping->email ); ?> </td>
						</tr>
						<!-- -------------------------------------------------------------------------------------------------------------- -->
						<tr>
							<td><label > A_ID &nbsp </label></td>
							<td> <?php echo( $shipping->id ); ?> </td>
						</tr>
						<tr>
							<td><label > Customer ID &nbsp </label></td>
							<td> <?php echo( $order->customerId ); ?> </td>
						</tr>
						<tr>
							<td><label > Order ID &nbsp </label></td>
							<td> <?php echo( $order->id ); ?> </td>
						</tr>
						<tr>
							<td><label> ShippingAddress &nbsp </label></td>
							<td> <?php echo( $shipping->address ); ?> </td>
						</tr>
						<tr>
							<td><label> Pincode &nbsp </label></td>
							<td> <?php echo( $shipping->pincode ); ?> </td>
						</tr>
						<tr>
							<td><label> City &nbsp </label></td>
							<td> <?php echo( $shipping->city ); ?> </td>
						</tr>
						<tr>
							<td><label> State &nbsp </label></td>
							<td> <?php echo( $shipping->state ); ?> </td>
						</tr>
						<tr>
							<td><label> Country &nbsp </label></td>
							<td> <?php echo( $shipping->country ); ?> </td>
						</tr>

						<tr>
							<td><label> Address TYPE  &nbsp </label></td>
							<td> <?php echo( $shipping->addressType ); ?> </td>                                           
						</tr>
					
					</table>

				</td>
			</tr>

			<tr>
				<td>
					<table>
						<tr>
							<td colspan="2"><label> Payment Method &nbsp </label></td>
						
							<tr><td><label> Payment ID &nbsp </label> <?php echo( $paymentMethod->id ); ?> </td></tr>
							<tr><td><label> Payment Name &nbsp </label> <?php echo( $paymentMethod->name ); ?>  </td></tr>
							<tr><td><label> Note &nbsp </label> <?php echo( $paymentMethod->note ); ?>  </td></tr>
						</tr>
					</table>
				</td>

				<td>
					<table>
						<tr>
							<td colspan="2"><label> Shipping Method &nbsp </label></td>
						
							<tr><td><label> Shipping ID &nbsp </label> <?php echo( $shippingMethod->id ); ?>   </td></tr>
							<tr><td><label> Shipping Name &nbsp </label> <?php echo( $shippingMethod->name ); ?>  </td></tr>
							<tr><td><label> Amount &nbsp </label> <?php echo( $shippingMethod->shippingAmount ); ?>  </td></tr>

						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<table>
						<tr>
							<td colspan="2"><label> OrderItems &nbsp </label></td>
						</tr>
						
						<?php foreach($orderItem as $key => $item) : ?>
							<tr>
								<td> Item-ID &nbsp : <?php echo $item->id ?> </td>
								<td> Order-ID &nbsp : <?php echo $order->id ?> </td>
								<td> Product-ID &nbsp : <?php echo $item->productId ?> </td>
								<td> Product-Name &nbsp :<?php echo $item->name ?>  </td>
								<td> Quantity &nbsp: <?php echo $item->quantity ?> </td>
								<td> Price &nbsp:<?php echo $item->price ?> </td>
								<td> Discount Amount &nbsp : <?php echo $item->discount; ?> </td>
							</tr>
						<?php endforeach ; ?>
					</table>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<table>
						<tr> <td colspan="2"><label> OrderDetails &nbsp </label></td> </tr>
						<tr> <td> Order-ID &nbsp : <?php echo $order->id; ?> </td> </tr>
						<tr> <td> Total &nbsp : <?php echo ($order->grandTotal + $order->discount); ?> </td> </tr>
						<tr> <td> Discount &nbsp : <?php echo $order->discount;  ?>  </td> </tr>
						<tr> <td> Shipping Charge &nbsp : <?php echo $order->getShippingMethod()->shippingAmount; ?> </td> </tr>
						<tr> <td> Grand Total &nbsp : <?php echo $order->grandTotal; ?> </td> </tr>
					</table>
				</td>
			</tr>
		</table>
	
<br>
<a href="<?php echo $this->getUrl("grid","Customer"); ?>"><button type="button">Back</button></a>



