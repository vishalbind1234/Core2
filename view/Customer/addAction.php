

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

		<form action="index.php?a=save&c=Customer" method="post">


			<table>                            

				<tr>
					<td colspan="2"><label> Person &nbsp </label></td>
					
				</tr>
				<tr>
					<td><label> First Name &nbsp </label></td>
					<td><input type="text" name=Person[firstName]></td>
				</tr>
				<tr>
					<td><label> Last Name &nbsp </label></td>
					<td><input type="text" name=Person[lastName]></td>
				</tr>
				<tr>
					<td><label> Email &nbsp </label></td>
					<td><input type="text" name=Person[email]></td>
				</tr>
				<tr>
					<td><label> Mobile &nbsp </label></td>
					<td><input type="number" name=Person[mobile]></td>
				</tr>
				<tr>
					<td><label> CreatedAt &nbsp </label></td>
					<td><input type="date" name=Person[createdAt]></td>
				</tr>
				<tr>
					<td><label hidden > UpdatedAt &nbsp </label></td>
					<td><input type="date" name=Person[updatedAt] value="" hidden ></td>     <!-- readonly , hidden , disable -->
				</tr>
				<!-- ----------------------------------------------------------------------------- -->
				<tr>
					<td colspan="2"><label> Address &nbsp </label></td>
					
				</tr>
				<tr>
					<td><label hidden > Customer ID &nbsp </label></td>
					<td><input type="number" name=Address[customerId] value="" hidden ></td>
				</tr>
				<tr>
					<td><label> Address &nbsp </label></td>
					<td><input type="text" name=Address[address]></td>
				</tr>
				<tr>
					<td><label> Pincode &nbsp </label></td>
					<td><input type="number" name=Address[pincode]></td>
				</tr>
				<tr>
					<td><label> City &nbsp </label></td>
					<td><input type="text" name=Address[city]></td>
				</tr>
				<tr>
					<td><label> State &nbsp </label></td>
					<td><input type="text" name=Address[state]></td>
				</tr>
				<tr>
					<td><label> Country &nbsp </label></td>
					<td><input type="text" name=Address[country]></td>
				</tr>
				<tr>
					<td><label> TYPE &nbsp </label></td>
					<td><label> Shipping &nbsp </label> <input type="checkbox" name=Address[billing] value="1">
					    <label> Billing &nbsp </label> <input  type="checkbox" name=Address[shipping] value="1"> </td>
				</tr>
				
			</table>

			<button type="submit"> Save </button>
			<button> <a href="index.php?a=grid&c=Customer"> Cancel </a> </button>

		</form>

		

	</body>

</html>