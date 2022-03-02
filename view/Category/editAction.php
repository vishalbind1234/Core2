
<?php  $currentCategory = $this->getCurrentCategory();   /*print_r($currentCategory);   exit();*/  ?>

<!DOCTYPE html>

<html>
	
	<head>
		<style type="text/css">
			table , tr , td {
				border:2px solid blue;
				border-collapse: collapse;
				width: 50%;
			}
		</style>
		

	</head>

	<body>
		
		<form action="<?php echo($this->getUrl('save' , 'Category' )); ?>" method="post" >
		
			<table>

				<tr>
					<td colspan="2"><label> Category &nbsp </label></td>
					
				</tr>

				<tr>
					<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
					<td><input type="number" name=Category[id] value=<?php echo( $currentCategory->id); ?>  readonly ></td>
				</tr>

				<tr>
					<td><label> Parent ID &nbsp </label></td>
					<td> 

						<select name=Category[parentId]   >
							<?php  $dropDownArray = $this->possibleOptions( $currentCategory->wholePath , $currentCategory->parentId ) ; ?>
							<option value="" >  No parent .  </option>
							<?php foreach($dropDownArray as $rowInDropDown) : ?>
								<option value=<?php echo($rowInDropDown['id']); ?> <?php if( $rowInDropDown['id'] == $currentCategory->parentId ){ echo(' selected'); } ?>  >  
								    <?php echo( $this->wholePathName($rowInDropDown['id']) )    ; ?>   
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
					<td><input type="text" name=Category[wholePath] readonly value=<?php echo( $currentCategory->wholePath); ?>  ></td>
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
				</tr>
				
				<tr>
					<td><label> CreatedAt &nbsp </label></td>
					<td><input type="date" name=Category[createdAt]  value=<?php echo( $currentCategory->createdAt); ?>   ></td>
				</tr>
				<tr>
					<td><label> UpdatedAt &nbsp </label></td>
					<td><input type="date" name=Category[updatedAt]  value=""  hidden ></td> 
				</tr>
				
			</table>

			<button type="submit" name="submit" value="submit"> Save </button>
			<button> <a href="<?php echo($this->getUrl('grid' , 'Category' )); ?>"> Cancel </a> </button>

		</form>
	
	</body>

</html>


