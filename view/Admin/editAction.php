
<?php   $admin = $this->getCurrentAdmin();   ?>

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

		<form action="<?php echo($this->getUrl('save' , 'Admin' )); ?>" method="post">


			<table>

				<tr>
					<td colspan="2"><label> Admin &nbsp </label></td>
					
				</tr>

				<tr>
					<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
					<td><input type="number" name=Admin[id] value=<?php echo $val = (!$admin) ? "" : ( $admin->id); ?>  readonly ></td>
				</tr>
				<tr>
					<td><label> First Name &nbsp </label></td>
					<td><input type="text" name=Admin[firstName]  value=<?php echo $val = (!$admin) ? "" : ( $admin->firstName); ?>   ></td>
				</tr>
				<tr>
					<td><label> Last Name &nbsp </label></td>
					<td><input type="text" name=Admin[lastName]  value=<?php echo $val = (!$admin) ? "" : ( $admin->lastName); ?>   ></td>
				</tr>
				<tr>
					<td><label> Email &nbsp </label></td>
					<td><input type="text" name=Admin[email]  value=<?php echo $val = (!$admin) ? "" : ( $admin->email); ?>   ></td>
				</tr>

				<tr>
					<td><label> Password &nbsp </label></td>
					<td><input type="Password" name=Admin[password] value=<?php echo $val = (!$admin) ? "" : ( $admin->password); ?> ></td>
				</tr>


				<tr>
					<td><label> Status &nbsp </label></td>
					<td><select name=Admin[status]> 
							<option value="1"> Active </option>
							<option value="2"> Inctive </option>
					    </select></td>
				</tr>
				
				<tr>
					<td><label> CreatedAt &nbsp </label></td>
					<td><input type="date" name=Admin[createdAt]  value=<?php echo $val = (!$admin) ? "" : ( $admin->createdAt); ?>   ></td>
				</tr>
				<tr>
					<td><label> UpdatedAt &nbsp </label></td>
					<td><input type="date" name=Admin[updatedAt]  value=""  hidden ></td> 
				</tr>
				<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

				

				
			</table>

			<button type="submit" name="submit" value="submit"> Save </button>
			<button> <a href="<?php echo($this->getUrl('grid' , 'Admin')); ?>"> Cancel </a> </button>

		</form>

		

	</body>

</html>