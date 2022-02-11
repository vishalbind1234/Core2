<?php

require_once("Model/Core/Adapter.php");
$adapter = new Model_Core_Adapter();

$query = "SELECT * FROM Admin " ;

$Admin = $adapter->fetch( $query );  //-----this fetch() is Adapter method-----

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

<button><a href="index.php?a=add&c=Admin">Add New</a></button>

<table>
<?php if(!$Admin): ?>

	<tr>
		<th>ID          </th>
		<th>First Name  </th>
		<th>Last Name   </th>
		<th>Email       </th>
		<th>Password      </th>
		<th>Status      </th>
		<th>CreatedAt   </th>
		<th>UpdatedAt   </th>

	</tr>
	<tr>
		<td colspan="8"><label> No Records Found . </label></td>
	</tr>
	
<?php else :  ?>

	<?php $Keys = array_keys($Admin['0']); ?>

	<tr>
	<?php foreach($Keys as $key) : ?>           <!-------------------- for table keys-------------- -->
			
			<th> <?php echo($key); ?> </th>
	
	<?php endforeach ; ?>
	</tr>

	<?php foreach($Admin as $admin) : ?>  <!-- -----------------for table data------------- -->
		<tr>
			<?php foreach($admin as $key => $value) : ?>

				<td> <?php echo($value);  ?> </td>

			<?php endforeach ; ?>                     
			<td> <a href="index.php?a=edit&id=<?php echo($admin['id']); ?>&c=Admin" > Edit  </a></td>  <!-- $admin is inner array -->
			<td> <a href="index.php?a=delete&id=<?php echo($admin['id']); ?>&c=Admin" > Delete </a> </td>  <!-- $admin is inner array -->
		</tr>
	<?php endforeach ; ?>                     
<?php endif ;  ?>

</table>	
		
	