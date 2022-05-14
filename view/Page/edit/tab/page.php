
<?php   $page = $this->getCurrentPage();  /*print_r($page);      exit();*/ ?>


<table>

	<tr>
		<td colspan="2"><label> Page &nbsp </label></td>
		
	</tr>

	<tr>
		<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
		<td><input type="number" name=Page[id] readonly value=<?php echo( $page->id); ?>   ></td>
	</tr>
	<tr>
		<td><label> Name &nbsp </label></td>
		<td><input type="text" name=Page[name]  value=<?php echo( $page->name); ?>   ></td>
	</tr>
	
	<tr>
		<td><label> Code &nbsp </label></td>
		<td><input type="text" name=Page[code]  value=<?php echo( $page->code); ?>   ></td>
	</tr>

	<tr>
		<td><label> Content &nbsp </label></td>
		<td><input type="value" name=Page[content] value=<?php echo( $page->content); ?> ></td>
	</tr>


	<tr>
	<td><label for="status"> Status &nbsp</label></td>
	<td>
		<select name="Page[status]">
			<?php foreach ($page->getStatus() as $key => $value) : ?>
				<option value="<?php echo($key); ?>"  <?php if($page->status == $key){echo('selected');} ?> > <?php echo($value); ?> </option>
			<?php endforeach ; ?>
		</select>
	</td>
	</tr>
	
	<tr>
		<td><label> CreatedAt &nbsp </label></td>
		<td><input type="date" name=Page[createdAt]  value=<?php echo( $page->createdAt); ?>   ></td>
	</tr>
	
	<tr>
		<td><label> UpdatedAt &nbsp </label></td>
		<td><input type="date" name=Page[updatedAt] hidden value=<?php echo( $page->updatedAt); ?>   ></td>
	</tr>

	<!-- -------------------------------------------------------------------------------------------------------------------------------- -->
	<tr>
		<td><button type="button" id="submit-button" value="<?php echo $this->getUrl('save','Page'); ?>"> Save </button></td>
		<td><button type="button" id="cancel-button" value="<?php echo $this->getUrl('index','Page'); ?>" > Cancel </button></td>
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