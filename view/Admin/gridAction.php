
<?php  $Admin =  $this->getAdmin();      ?>
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

<button><a href="<?php echo($this->getUrl('edit' , 'Admin' , [] , true)); ?>">Add New</a></button>

<table>

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

<?php if(!$Admin): ?>
	<tr>
		<td colspan="8"><label> No Records Found . </label></td>
	</tr>
	
<?php else :  ?>

	</tr>

	<?php foreach($Admin as $admin) : ?>  <!-- -----------------for table data------------- -->
		<tr>
			<?php foreach($admin->getData() as $key => $value) : ?>

				<td> <?php echo($value);  ?> </td>

			<?php endforeach ; ?>
			<td> <a href="<?php echo($this->getUrl('edit' , 'Admin' , ['id' => $admin->id ] )); ?>" > Edit  </a></td> 
			<td> <a href="<?php echo($this->getUrl('delete' , 'Admin' , ['id' => $admin->id ] )); ?>" > Delete </a> </td> 
		</tr>
	<?php endforeach ; ?>                     
<?php endif ;  ?>

</table>	
		
	