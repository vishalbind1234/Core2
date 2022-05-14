
<?php   $customer = $this->getCurrentCustomer(); ?>
<table>
	
	<tr>
		<td colspan="2"><label> Person &nbsp </label></td>
		
	</tr>

	<tr>
		<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
		<td><input type="number" name=Person[id] value="<?php echo( $customer->id ); ?>" <?php if(!$customer->id){echo "hidden";} ?> ></td>
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

	<tr>
		<td><button type="button" id="submit-button" value="<?php echo $this->getUrl('save','Customer'); ?>"> Save </button></td>
		<td><button type="button" id="cancel-button" value="<?php echo $this->getUrl('index','Customer'); ?>" > Cancel </button></td>
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