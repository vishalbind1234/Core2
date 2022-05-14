
<?php   $paymentMethod = $this->getCurrentPaymentMethod();  /*print_r($paymentMethod);      exit();*/ ?>


<table>

	<tr>
		<td colspan="2"><label> PaymentMethod &nbsp </label></td>
		
	</tr>

	<tr>
		<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
		<td><input type="number" name=PaymentMethod[id] readonly value=<?php echo( $paymentMethod->id); ?>   ></td>
	</tr>
	<tr>
		<td><label> Name &nbsp </label></td>
		<td><input type="text" name=PaymentMethod[name]  value=<?php echo( $paymentMethod->name); ?>   ></td>
	</tr>
	<tr>
		<td><label> Note &nbsp </label></td>
		<td><input type="text" name=PaymentMethod[note]  value=<?php echo( $paymentMethod->note); ?>   ></td>
	</tr>
	
	
	<tr>
	<td><label for="status"> Status &nbsp</label></td>
	<td>
		<select name="PaymentMethod[status]">
			<?php foreach ($paymentMethod->getStatus() as $key => $value) : ?>
				<option value="<?php echo($key); ?>"  <?php if($paymentMethod->status == $key){echo('selected');} ?> > <?php echo($value); ?> </option>
			<?php endforeach ; ?>
		</select>
	</td>
	</tr>
	
	<tr>
		<td><label> CreatedAt &nbsp </label></td>
		<td><input type="date" name=PaymentMethod[createdAt]  value=<?php echo( $paymentMethod->createdAt); ?>   ></td>
	</tr>
	
	<!-- -------------------------------------------------------------------------------------------------------------------------------- -->
	<tr>
		<td><button type="button" id="submit-button" value="<?php echo $this->getUrl('save','Cart_PaymentMethod'); ?>"> Save </button></td>
		<td><button type="button" id="cancel-button" value="<?php echo $this->getUrl('index','Cart_PaymentMethod'); ?>" > Cancel </button></td>
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