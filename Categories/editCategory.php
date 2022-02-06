
<?php

require_once("../Adapter.php");
$adapter = new Adapter();

$current_record = $adapter->fetch("select * from Categories where id =" . $_GET['id'] );


?>

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

		<form action="Categories.php?a=saveCategory" method="post">


			<table>

				<tr>
					<td colspan="2"><label> Category &nbsp </label></td>
					
				</tr>

				<tr>
					<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
					<td><input type="number" name=Category[id] value=<?php echo( $current_record[0]['id']); ?>  readonly ></td>
				</tr>
				<tr>
					<td><label> Name &nbsp </label></td>
					<td><input type="text" name=Category[name]  value=<?php echo( $current_record[0]['name']); ?>   ></td>
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
					<td><input type="date" name=Category[createdAt]  value=<?php echo( $current_record[0]['createdAt']); ?>   ></td>
				</tr>
				<tr>
					<td><label> UpdatedAt &nbsp </label></td>
					<td><input type="date" name=Category[updatedAt]  value=<?php echo( date('Y-m-d') ); ?>  hidden ></td> 
				</tr>
				
			</table>

			<button type="submit" name="submit" value="submit"> Save </button>
			<button> <a href="Categories.php?a=gridCategory"> Cancel </a> </button>

		</form>

		

	</body>

</html>

