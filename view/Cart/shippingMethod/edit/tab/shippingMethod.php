
<?php   $shippingMethod = $this->getCurrentShippingMethod();  /*print_r($shippingMethod);      exit();*/ ?>


<table>

	<tr>
		<td colspan="2"><label> ShippingMethod &nbsp </label></td>
		
	</tr>

	<tr>
		<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
		<td><input type="number" name=ShippingMethod[id] readonly value=<?php echo( $shippingMethod->id); ?>   ></td>
	</tr>
	<tr>
		<td><label> Name &nbsp </label></td>
		<td><input type="text" name=ShippingMethod[name]  value=<?php echo( $shippingMethod->name); ?>   ></td>
	</tr>
	
	<tr>
		<td><label> SHipping Amount &nbsp </label></td>
		<td><input type="text" name=ShippingMethod[shippingAmount]  value=<?php echo( $shippingMethod->shippingAmount); ?>   ></td>
	</tr>



	<!-- -------------------------------------------------------------------------------------------------------------------------------- -->
	<tr>
		<td><button type="button" id="submit-button" value="<?php echo $this->getUrl('save','Cart_ShippingMethod'); ?>"> Save </button></td>
		<td><button type="button" id="cancel-button" value="<?php echo $this->getUrl('index','Cart_ShippingMethod'); ?>" > Cancel </button></td>
	</tr>

	
</table>

	
<script type="text/javascript">
	
	jQuery("#cancel-button").click(function(){

		var url = jQuery(this).val();
		admin.setUrl(url).load();

	});

	jQuery("#submit-button").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.setData(jQuery("#edit-form").serializeArray());
		admin.load();

	});


	
	
</script>