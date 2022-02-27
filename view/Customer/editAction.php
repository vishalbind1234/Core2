
<?php   $customers = $this->getCurrentCustomer();  ?>

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

		<form action="<?php echo($this->getUrl('save' , 'Customer' )); ?>" method="post">


			<table>

				<tr>
					<td colspan="2"><label> Person &nbsp </label></td>
					
				</tr>

				<tr>
					<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
					<td><input type="number" name=Person[id] value=<?php echo( $customers->id ); ?>  readonly ></td>
				</tr>
				<tr>
					<td><label> First Name &nbsp </label></td>
					<td><input type="text" name=Person[firstName]  value=<?php echo( $customers->firstName ); ?>   ></td>
				</tr>
				<tr>
					<td><label> Last Name &nbsp </label></td>
					<td><input type="text" name=Person[lastName]  value=<?php echo( $customers->lastName ); ?>   ></td>
				</tr>
				<tr>
					<td><label> Email &nbsp </label></td>
					<td><input type="text" name=Person[email]  value=<?php echo( $customers->email ); ?>   ></td>
				</tr>
				<tr>
					<td><label> Mobile &nbsp </label></td>
					<td><input type="number" name=Person[mobile]  value=<?php echo( $customers->mobile ); ?>   ></td>
				</tr>
				<tr>
					<td><label> CreatedAt &nbsp </label></td>
					<td><input type="date" name=Person[createdAt]  value=<?php echo( $customers->createdAt ); ?>   ></td>
				</tr>
				<tr>
					<td><label> UpdatedAt &nbsp </label></td>
					<td><input type="date" name=Person[updatedAt]  value=""  hidden ></td> 
				</tr>
				<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

				<tr>
					<td colspan="2"><label> Address &nbsp </label></td>
					
				</tr>
				<tr>
					<td><label > A_ID &nbsp </label></td>
					<td><input type="number" name=Address[aId] value=<?php echo( $customers->aId ); ?>  readonly ></td>
				</tr>
				<tr>
					<td><label > Customer ID &nbsp </label></td>
					<td><input type="number" name=Address[customerId] value=<?php echo( $customers->customerId ); ?> readonly ></td>
				</tr>
				<tr>
					<td><label> Address &nbsp </label></td>
					<td><input type="text" name=Address[address] value=<?php echo( $customers->address ); ?> ></td>
				</tr>
				<tr>
					<td><label> Pincode &nbsp </label></td>
					<td><input type="number" name=Address[pincode] value=<?php echo( $customers->pincode ); ?> ></td>
				</tr>
				<tr>
					<td><label> City &nbsp </label></td>
					<td><input type="text" name=Address[city] value=<?php echo( $customers->city ); ?> ></td>
				</tr>
				<tr>
					<td><label> State &nbsp </label></td>
					<td><input type="text" name=Address[state] value=<?php echo( $customers->state ); ?> ></td>
				</tr>
				<tr>
					<td><label> Country &nbsp </label></td>
					<td><input type="text" name=Address[country]  value=<?php echo( $customers->country ); ?>  ></td>
				</tr>
				<tr>
					<td><label> TYPE &nbsp </label></td>
					<td>
						<label> Billing &nbsp </label> <input type="checkbox" name=Address[billing] value="1"
						                                               <?php 
						                                                   if($customers->billing  == 1 ){
						                                       		        	echo("checked");
						                                       		        }
						                                               ?> >
						<label> Shipping &nbsp </label> <input type="checkbox" name=Address[shipping] value="1"
						                                               <?php 
						                                                   if($customers->shipping  == 1 ){
						                                       		        	 echo("checked");
						                                       		        }
						                                               ?> > 
					</td>
				</tr>
								
			</table>

			<button type="submit"> Save </button>
			<button> <a href="<?php echo($this->getUrl('grid' , 'Customer' )); ?>"> Cancel </a> </button>

		</form>

		

	</body>

</html>