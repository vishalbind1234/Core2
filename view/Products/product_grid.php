<style>
	table , tr , th ,td {
		border:2px solid red;
		border-collapse: collapse;
	
	}
	table{
		
		width:90%;
	}
</style>

<button><a href="index.php?a=add&c=Products">Add New</a></button>

<table>

<?php if(!$data): ?>

	<tr>
		<th>ID           </th>
		<th>Product Name </th>
		<th>Price Name   </th>
		<th>Quantity     </th>
		<th>Status       </th>
		<th>CreatedAt    </th>
		<th>UpdatedAt    </th>
		
	</tr>
	<tr>
		<td colspan="7"><label> No Records Found . </label></td>
	</tr>
	
<?php else :  ?>

	<?php $Keys = array_keys($data['0']); ?>

	<tr>
	<?php foreach($Keys as $key) : ?>           <!-------------------- for table keys-------------- -->
			
			<th> <?php echo($key); ?> </th>
	
	<?php endforeach ; ?>
	</tr>

	<?php foreach($data as $product) : ?>  <!-- -----------------for table data------------- -->
		<tr>
			<?php foreach($product as $key => $value) : ?>

				<td> <?php echo($value);  ?> </td>

			<?php endforeach ; ?>                     
			<td> <a href="index.php?a=edit&id=<?php echo($product['id']); ?>&c=Products" > Edit  </a> </td>  <!-- $product is inner array -->
			<td> <a href="index.php?a=delete&id=<?php echo($product['id']); ?>&c=Products" > Delete </a> </td>  <!-- $product is inner array -->
		</tr>
	<?php endforeach ; ?>                     
<?php endif ;  ?>

</table>	



