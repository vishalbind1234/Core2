
<?php   $vendor = $this->getCurrentVendor(); /*echo "<pre>";  print_r($vendor);  exit();*/  ?>
<?php   $address = $vendor->getAddress(); ?>

<table>
	
	<tr>
		<td colspan="2"><label> Address Information &nbsp </label></td>
	</tr>
	<tr>
		<td><label > A_ID &nbsp </label></td>
		<td><input type="number" name=Address[addressId] value="<?php echo( $address->addressId ); ?>"  readonly ></td>
	</tr>
	<tr>
		<td><label > Vendor ID &nbsp </label></td>
		<td><input type="number" name=Address[vendorId] value="<?php echo( $address->vendorId ); ?>" readonly ></td>
	</tr>
	
	<tr>
		<td><label> Pincode &nbsp </label></td>
		<td><input type="number" name=Address[pincode] value="<?php echo( $address->pincode ); ?>" ></td>
	</tr>
	<tr>
		<td><label> City &nbsp </label></td>
		<td><input type="text" name=Address[city] value="<?php echo( $address->city ); ?>" ></td>
	</tr>
	<tr>
		<td><label> State &nbsp </label></td>
		<td><input type="text" name=Address[state] value="<?php echo( $address->state ); ?>" ></td>
	</tr>
	<tr>
		<td><label> Country &nbsp </label></td>
		<td><input type="text" name=Address[country]  value="<?php echo ($address->country); ?>"  ></td>
	</tr>
		
	<!-- ------------------------------------------------------------------------------------------------------------------------ -->
	
	<tr>
		<td><button type="button" id="submit-button" value="<?php echo $this->getUrl('save','Vendor'); ?>"> Save </button></td>
		<td><button type="button" id="cancel-button" value="<?php echo $this->getUrl('index','Vendor'); ?>" > Cancel </button></td>
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
	
	
