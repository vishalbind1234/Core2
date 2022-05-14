
<?php $cart = $this->getCart();  ?>
<table class="table" >
	<tr> <td colspan="2"><label> CartDetails &nbsp </label></td> </tr>
	<tr> <td> Cart-ID &nbsp <input type="number" name=Cart[cartSummary][cartId]  value="<?php echo $cart->id ?>"> </td> </tr>
	<tr> <td> Total &nbsp <input type="number" name=Cart[cartSummary][cartTotal] value="<?php echo ($cart->cartTotal + $cart->discount); ?>"> </td> </tr>
	<tr> <td> Discount &nbsp <input type="number" name=Cart[cartSummary][discount] value="<?php echo $cart->discount  ?>">  </td> </tr>
	<tr> <td> Shipping Charge &nbsp <input type="number" name=Cart[cartSummary][shippingCharges] value="<?php echo $cart->shippingCharge ;?>"> </td> </tr>
	<tr> <td> Grand Total &nbsp <input type="number" name=Cart[cartSummary][grandTotal] value="<?php echo ($cart->cartTotal + $cart->shippingCharge) ;?>"> </td> </tr>
</table>