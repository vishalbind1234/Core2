
<?php  $currentCategory = $this->getCurrentCategory();   /*print_r($currentCategory);   exit();*/  ?>


<table>

	<tr>
		<td colspan="2"><label> Category &nbsp </label></td>
	</tr>

	<tr>
		<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
		<td><input type="number" name=Category[id] value=<?php echo $currentCategory->id; ?>  readonly ></td>
	</tr>

	<tr>
		<td><label> Parent ID &nbsp </label></td>
		<td> 

			<select name=Category[parentId]   >
				<?php  $dropDownArray = $this->possibleOptions($currentCategory->wholePath , $currentCategory->parentId) ; ?>
				<option value="" >  No parent .  </option>
				<?php foreach($dropDownArray as $rowInDropDown) : ?>
					<option value=<?php echo($rowInDropDown['id']); ?> <?php if($rowInDropDown['id'] == $currentCategory->parentId){ echo 'selected'; } ?>  >  
					    <?php echo( $this->getWholePathName($rowInDropDown['id']) )    ; ?>   
					</option>
					<?php endforeach ; ?>	
			</select> 
		</td>
	</tr>
	
	<tr>
		<td><label> Name &nbsp </label></td>
		<td><input type="text" name=Category[name] value=<?php echo( $currentCategory->name); ?>   ></td>
	</tr>

	<tr>
		<td><label> Category Whole Path &nbsp </label></td>
		<td><input type="text" name=Category[wholePath] readonly value="<?php echo( $this->getWholePathName($currentCategory->id)); ?>"  ></td>
	</tr>
	
	<tr>
	<td><label for="status"> Status &nbsp</label></td>
	<td>
		<select name="Category[status]">
			<?php foreach ($currentCategory->getStatus() as $key => $value) : ?>
				<option value="<?php echo($key); ?>"  <?php if($currentCategory->status == $key){echo('selected');} ?> > <?php echo($value); ?> </option>
			<?php endforeach ; ?>
		</select>
	</td>
	
	
	<tr>
		<td><label> CreatedAt &nbsp </label></td>
		<td><input type="date" name=Category[createdAt]  value=<?php echo( $currentCategory->createdAt); ?>   ></td>
	</tr>
	<tr>
		<td><label> UpdatedAt &nbsp </label></td>
		<td><input type="date" name=Category[updatedAt]  value=""  hidden ></td> 
	</tr>

	<tr>
		<td><button type="button" id="submit-button" value="<?php echo $this->getUrl('save','Category'); ?>"> Save </button></td>
		<td><button type="button" id="cancel-button" value="<?php echo $this->getUrl('index','Category'); ?>" > Cancel </button></td>
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
		