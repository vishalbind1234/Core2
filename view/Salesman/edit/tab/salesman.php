
<?php  $salesman = $this->getCurrentSalesman();  /*print_r($salesman);  exit();*/ ?>
	  


<table>

	<tr>
	<td><label for="id">Salesman Id  &nbsp</label></td>
	<td><input type="number" id="id" name="Salesman[id]" <?php if(!$salesman->id){echo "hidden";} ?> readonly placeholder="enter id" value=<?php echo ($salesman->id); ?>  ></td>
	</tr>

	
	<tr>
	<td><label for="firstName">First Name  &nbsp</label></td>
	<td><input type="text" id="firstName" name="Salesman[firstName]" placeholder="enter firstName" value=<?php echo ($salesman->firstName); ?>   ></td>
	</tr>

	<tr>
	<td><label for="lastName">Last Name  &nbsp</label></td>
	<td><input type="text" id="lastName" name="Salesman[lastName]" placeholder="enter lastName" value=<?php echo ($salesman->lastName); ?>   ></td>
	</tr>

	
	<tr>
	<td><label for="email">Email  &nbsp</label></td>
	<td><input type="text" id="email" name="Salesman[email]" placeholder="enter email" value=<?php echo ($salesman->email); ?>   ></td>
	</tr>

	
	<tr>
	<td><label for="mobile"> Mobile  &nbsp</label></td>
	<td><input type="number" id="mobile" name="Salesman[mobile]" placeholder="enter mobile" value=<?php echo ($salesman->mobile); ?>  ></td>
	</tr>

	
	<tr>
	<td><label for="status">Salesman Status &nbsp</label></td>
	<td>
		<select name="Salesman[status]">
			<?php foreach ($salesman->getStatus() as $key => $value) : ?>
				<option value="<?php echo ($key); ?>"  <?php if($salesman->status == $key){echo ('selected');} ?> > <?php echo ($value); ?> </option>
			<?php endforeach ; ?>
		</select>
	</td>
	</tr>

	<tr>
	<td><label for="createdAt">CreatedAt  &nbsp</label></td>
	<td><input type="date"  id="createdAt" name="Salesman[createdAt]" placeholder="createdAt" value=<?php echo ($salesman->createdAt); ?> ></td>
	</tr>

	<tr>
	<td><label for="percentage">Percentage  &nbsp</label></td>
	<td><input type="number"  id="percentage" name="Salesman[percentage]" placeholder="percentage" value=<?php echo ($salesman->percentage); ?> ></td>
	</tr>

	<tr>
		<td><button type="button" id="submit-button" value="<?php echo $this->getUrl('save','Salesman'); ?>"> Save </button></td>
		<td><button type="button" id="cancel-button" value="<?php echo $this->getUrl('index','Salesman'); ?>" > Cancel </button></td>
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