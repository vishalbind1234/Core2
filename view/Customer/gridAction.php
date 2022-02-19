<?php   $customers = $this->getCustomer();   ?>

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

<button><a href="index.php?a=add&c=Customer">Add New</a></button>

<table>
<?php if(!$customers): ?>

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

	<?php $Keys = array_keys($customers['0']); ?>

	<tr>
	<?php foreach($Keys as $key) : ?>           <!-------------------- for table keys-------------- -->
			
			<th> <?php echo($key); ?> </th>
	
	<?php endforeach ; ?>
	</tr>

	<?php foreach($customers as $customer) : ?>  <!-- -----------------for table data------------- -->
		<tr>
			<?php foreach($customer as $key => $value) : ?>

				<td> <?php echo($value);  ?> </td>

			<?php endforeach ; ?>                     
			<td> <a href="index.php?a=edit&id=<?php echo($customer['id']); ?>&c=Customer" > Edit  </a> </td>  <!-- $customer is inner array -->
			<td> <a href="index.php?a=delete&id=<?php echo($customer['id']); ?>&c=Customer" > Delete </a> </td>  <!-- $customer is inner array -->
		</tr>
	<?php endforeach ; ?>                     
<?php endif ;  ?>

</table>	
		
	