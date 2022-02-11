
<?php
                             
require_once("Model/Core/Adapter.php"); 
$adapter = new Model_Core_Adapter();    


$current_record = $adapter->fetch("SELECT * FROM  Customers c 
	                                              INNER JOIN 
	                                              Address a ON c.id = a.customerId
	                                        WHERE c.id = " . $_GET['id'] );


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

		<form action="index.php?a=save&c=Customers" method="post">


			<table>

				<tr>
					<td colspan="2"><label> Person &nbsp </label></td>
					
				</tr>

				<tr>
					<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
					<td><input type="number" name=Person[id] value=<?php echo( $current_record[0]['id']); ?>  readonly ></td>
				</tr>
				<tr>
					<td><label> First Name &nbsp </label></td>
					<td><input type="text" name=Person[firstName]  value=<?php echo( $current_record[0]['firstName']); ?>   ></td>
				</tr>
				<tr>
					<td><label> Last Name &nbsp </label></td>
					<td><input type="text" name=Person[lastName]  value=<?php echo( $current_record[0]['lastName']); ?>   ></td>
				</tr>
				<tr>
					<td><label> Email &nbsp </label></td>
					<td><input type="text" name=Person[email]  value=<?php echo( $current_record[0]['email']); ?>   ></td>
				</tr>
				<tr>
					<td><label> Mobile &nbsp </label></td>
					<td><input type="number" name=Person[mobile]  value=<?php echo( $current_record[0]['mobile']); ?>   ></td>
				</tr>
				<tr>
					<td><label> CreatedAt &nbsp </label></td>
					<td><input type="date" name=Person[createdAt]  value=<?php echo( $current_record[0]['createdAt']); ?>   ></td>
				</tr>
				<tr>
					<td><label> UpdatedAt &nbsp </label></td>
					<td><input type="date" name=Person[updatedAt]  value=<?php echo( date('Y-m-d') ); ?>  hidden ></td> 
				</tr>
				<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

				<tr>
					<td colspan="2"><label> Address &nbsp </label></td>
					
				</tr>
				<tr>
					<td><label > A_ID &nbsp </label></td>
					<td><input type="number" name=Address[aId] value=<?php echo( $current_record[0]['aId']); ?>  readonly ></td>
				</tr>
				<tr>
					<td><label > Customer ID &nbsp </label></td>
					<td><input type="number" name=Address[customerId] value=<?php echo( $current_record[0]['customerId']); ?> readonly ></td>
				</tr>
				<tr>
					<td><label> Address &nbsp </label></td>
					<td><input type="text" name=Address[address] value=<?php echo( $current_record[0]['address']); ?> ></td>
				</tr>
				<tr>
					<td><label> Pincode &nbsp </label></td>
					<td><input type="number" name=Address[pincode] value=<?php echo( $current_record[0]['pincode']); ?> ></td>
				</tr>
				<tr>
					<td><label> City &nbsp </label></td>
					<td><input type="text" name=Address[city] value=<?php echo( $current_record[0]['city']); ?> ></td>
				</tr>
				<tr>
					<td><label> State &nbsp </label></td>
					<td><input type="text" name=Address[state] value=<?php echo( $current_record[0]['state']); ?> ></td>
				</tr>
				<tr>
					<td><label> Country &nbsp </label></td>
					<td><input type="text" name=Address[country]  value=<?php echo( $current_record[0]['country']); ?>  ></td>
				</tr>
				<tr>
					<td><label> TYPE &nbsp </label></td>
					<td>
						<label> Billing &nbsp </label> <input type="checkbox" name=Address[billing] value="1"
						                                               <?php 
						                                                   if($current_record[0]['billing'] == 1 ){
						                                       		        	echo("checked");
						                                       		        }
						                                               ?> >
						<label> Shipping &nbsp </label> <input type="checkbox" name=Address[shipping] value="1"
						                                               <?php 
						                                                   if($current_record[0]['shipping'] == 1 ){
						                                       		        	 echo("checked");
						                                       		        }
						                                               ?> > 
					</td>
				</tr>
				

				
			</table>

			<button type="submit" name="submit" value="submit"> Save </button>
			<button> <a href="index.php?a=grid&c=Customers"> Cancel </a> </button>

		</form>

		

	</body>

</html>