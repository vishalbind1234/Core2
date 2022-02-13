

<!DOCTYPE html>

<html>
	
	<head>
		<style type="text/css">
			table , tr , td {
				border:2px solid blue;
				border-collapse: collapse;
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
					<td><label> Parent ID &nbsp </label></td>
					<td> <select name=Category[parentId]   >
							<option value=""  selected   >  No parent .  </option>
							<?php foreach($data['Categories'] as $row) : ?>
								
								<option value=<?php echo($row['id']); ?>  >  <?php echo($row['name']); ?>   </option>

							<?php endforeach ; ?>	
						</select> 
					</td>
				</tr>
				
				<tr>
					<td><label> Category Name &nbsp </label></td>
					<td><input type="text" name=Category[name]></td>
				</tr>

				<tr>
					<td><label> Category Whole Path &nbsp </label></td>
					<td><input type="text" value=""  name=Category[wholePath] readonly ></td>
				</tr>

				<tr>
					<td><label> Status &nbsp </label></td>
					<td><select name=Category[status]> 
							<!-- <option readonly > select </option> -->
							<option value="1"> Active </option>
							<option value="2"> Inctive </option>
					    </select></td>
				</tr>

				<tr>
					<td><label> CreatedAt &nbsp </label></td>
					<td><input type="date" name=Category[createdAt]></td>
				</tr>

				<tr>
					<td><label> UpdatedAt &nbsp </label></td>
					<td><input type="date" name=Category[updatedAt] value="" hidden ></td>     <!-- readonly , hidden , disable -->
				</tr>
				
			</table>

			<button type="submit" name="submit" value="submit"> Save </button>
			<button> <a href="index.php?a=grid&c=Categories"> Cancel </a> </button>

		</form>

		

	</body>

</html>