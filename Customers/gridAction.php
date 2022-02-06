<?php

require_once("../Adapter.php");
$adapter = new Adapter();

$query = "SELECT * FROM Customers c INNER JOIN Address a ON c.id = a.customerId" ;

$Customers = $adapter->fetch( $query );  //-----this fetch() is Adapter method-----

?>

<style>
	table , tr , th ,td {
		border:2px solid blue;
		border-collapse: collapse;
	
	}
	table{
		
		background:pink;
		width:90%;

	}
</style>

<button><a href="Customers.php?a=addAction">Add New</a></button>

<table>
<?php if(!$Customers): ?>

	<tr>
		<th>ID          </th>
		<th>First Name  </th>
		<th>Last Name   </th>
		<th>Email       </th>
		<th>Mobile      </th>
		<th>CreatedAt   </th>
		<th>UpdatedAt   </th>

		<th>AddressID   </th>
		<th>Customer Id </th>
		<th>Address     </th>
		<th>Pincode     </th>
		<th>City        </th>
		<th>State       </th>
		<th>Country     </th>
		<th>Billing     </th>
		<th>Shipping    </th>
	</tr>
	<tr>
		<td colspan="16"><label> No Records Found . </label></td>
	</tr>
	
<?php else :  ?>

	<?php $Keys = array_keys($Customers['0']); ?>

	<tr>
	<?php foreach($Keys as $key) : ?>           <!-------------------- for table keys-------------- -->
			
			<th> <?php echo($key); ?> </th>
	
	<?php endforeach ; ?>
	</tr>

	<?php foreach($Customers as $customer) : ?>  <!-- -----------------for table data------------- -->
		<tr>
			<?php foreach($customer as $key => $value) : ?>

				<td> <?php echo($value);  ?> </td>

			<?php endforeach ; ?>                     
			<td> <a href="Customers.php?a=editAction&id=<?php echo($customer['id']);?>"> Edit  </a> </td>  <!-- $customer is inner array -->
			<td> <a href="Customers.php?a=deleteAction&id=<?php echo($customer['id']);?>"> Delete </a> </td>  <!-- $customer is inner array -->
		</tr>
	<?php endforeach ; ?>                     
<?php endif ;  ?>

</table>	
		
	