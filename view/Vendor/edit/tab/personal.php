
<?php   $vendor = $this->getCurrentVendor(); ?>
<table>
	
	<tr>
		<td colspan="2"><label> Person &nbsp </label></td>
		
	</tr>

	<tr>
		<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
		<td><input type="number" name=Person[id] value="<?php echo( $vendor->id ); ?>" <?php if(!$vendor->id){echo "hidden";} ?> ></td>
	</tr>
	<tr>
		<td><label> First Name &nbsp </label></td>
		<td><input type="text" name=Person[firstName]  value="<?php echo( $vendor->firstName ); ?>"   ></td>
	</tr>
	<tr>
		<td><label> Last Name &nbsp </label></td>
		<td><input type="text" name=Person[lastName]  value="<?php echo( $vendor->lastName ); ?>"   ></td>
	</tr>
	<tr>
		<td><label> Email &nbsp </label></td>
		<td><input type="text" name=Person[email]  value="<?php echo( $vendor->email ); ?>"   ></td>
	</tr>
	<tr>
		<td><label> Mobile &nbsp </label></td>
		<td><input type="number" name=Person[mobile]  value="<?php echo( $vendor->mobile ); ?>"   ></td>
	</tr>
	<tr>
		<td><label> Status &nbsp </label></td>
		<td>
			<select name="Person[status]">
				<?php foreach($vendor->getStatus() as $key => $value) : ?>
					<option value="<?php echo $key; ?>" <?php if($key == $vendor->status){echo "selected";} ?> > <?php echo $value; ?> </option>		
				<?php endforeach; ?>	
			</select>
		</td>
	</tr>
	<tr>
		<td><label> CreatedAt &nbsp </label></td>
		<td><input type="date" name=Person[createdAt]  value="<?php echo( $vendor->createdAt ); ?>"   ></td>
	</tr>
	<tr>
		<td><label> UpdatedAt &nbsp </label></td>
		<td><input type="date" name=Person[updatedAt]  value="<?php echo( $vendor->updatedAt ); ?>"  hidden ></td> 
	</tr>

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