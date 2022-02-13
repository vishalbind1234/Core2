
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

		<form action="index.php?a=save&c=Categories" method="post">


			<table>

				<tr>
					<td colspan="2"><label> Category &nbsp </label></td>
					
				</tr>

				<tr>
					<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
					<td><input type="number" name=Category[id] value=<?php echo( $data['Categories'][0]['id']); ?>  readonly ></td>
				</tr>

				<tr>
					<td><label> Parent ID &nbsp </label></td>
					<td> <select name=Category[parentId]   >
							<option value="" >  No parent .  </option>
							<?php foreach($data['Parent'] as $rowInDropDown) : ?>
								
 								<?php if( canBePlaced($rowInDropDown['id'] , $data['Categories'][0]['parentId']) ) : ?>
								
									<option value=<?php echo($rowInDropDown['id']); ?> <?php if( $rowInDropDown['id'] == $data['Categories'][0]['parentId'] ){ echo(' selected'); } ?>   >  
									    <?php echo($rowInDropDown['name']); ?>   
									</option>

 								<?php endif ; ?>	

							<?php endforeach ; ?>	
						</select> 
					</td>
				</tr>

				<tr>
					<td><label> Name &nbsp </label></td>
					<td><input type="text" name=Category[name] value=<?php echo( $data['Categories'][0]['name']); ?>   ></td>
				</tr>

				<tr>
					<td><label> Category Whole Path &nbsp </label></td>
					<td><input type="text" value=""  name=Category[wholePath]  value=<?php echo( $data['Categories'][0]['wholePath']); ?>  ></td>
				</tr>
				
				<tr>
					<td><label> Status &nbsp </label></td>
					<td> <select name=Category[status]> 
							<!-- <option readonly > select </option> -->
							<option value="1"> Active </option>
							<option value="2"> Inctive </option>
					    </select> </td>
				</tr>
				
				<tr>
					<td><label> CreatedAt &nbsp </label></td>
					<td><input type="date" name=Category[createdAt]  value=<?php echo( $data['Categories'][0]['createdAt']); ?>   ></td>
				</tr>
				<tr>
					<td><label> UpdatedAt &nbsp </label></td>
					<td><input type="date" name=Category[updatedAt]  value=<?php echo( date('Y-m-d') ); ?>  hidden ></td> 
				</tr>
				
			</table>

			<button type="submit" name="submit" value="submit"> Save </button>
			<button> <a href="index.php?a=grid&c=Categories"> Cancel </a> </button>

		</form>

		

	</body>

</html>

