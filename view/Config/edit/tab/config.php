
<?php   $config = $this->getCurrentConfig();  /*print_r($config);      exit();*/ ?>


<table>

	<tr>
		<td colspan="2"><label> Config &nbsp </label></td>
		
	</tr>

	<tr>
		<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
		<td><input type="number" name=Config[id] readonly value=<?php echo( $config->id); ?>   ></td>
	</tr>
	<tr>
		<td><label> Name &nbsp </label></td>
		<td><input type="text" name=Config[name]  value=<?php echo( $config->name); ?>   ></td>
	</tr>
	
	<tr>
		<td><label> Code &nbsp </label></td>
		<td><input type="text" name=Config[code]  value=<?php echo( $config->code); ?>   ></td>
	</tr>

	<tr>
		<td><label> Value &nbsp </label></td>
		<td><input type="value" name=Config[value] value=<?php echo( $config->value); ?> ></td>
	</tr>


	<tr>
	<td><label for="status"> Status &nbsp</label></td>
	<td>
		<select name="Config[status]">
			<?php foreach ($config->getStatus() as $key => $value) : ?>
				<option value="<?php echo($key); ?>"  <?php if($config->status == $key){echo('selected');} ?> > <?php echo($value); ?> </option>
			<?php endforeach ; ?>
		</select>
	</td>
	</tr>
	
	<tr>
		<td><label> CreatedAt &nbsp </label></td>
		<td><input type="date" name=Config[createdAt]  value=<?php echo( $config->createdAt); ?>   ></td>
	</tr>
	
	<!-- -------------------------------------------------------------------------------------------------------------------------------- -->
	<tr>
		<td><button type="button" id="submit-button" value="<?php echo $this->getUrl('save','Config'); ?>"> Save </button></td>
		<td><button type="button" id="cancel-button" value="<?php echo $this->getUrl('index','Config'); ?>" > Cancel </button></td>
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