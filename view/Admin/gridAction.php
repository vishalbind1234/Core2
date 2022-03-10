
<?php  $Admin =  $this->getAdmin();      ?>

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

					<?php if($key == 'status'): ?>
					<?php $array = $admin->getStatus(); ?>

						<td> <label> <?php echo($array[$value]);  ?> </label> </td>

					<?php else: ?>

						<td> <?php echo($value);  ?> </td>

					<?php endif ;  ?>

				<?php endforeach ; ?>
				<td> <a href="<?php echo($this->getUrl('edit' , 'Admin' , ['id' => $admin->id ] )); ?>" > Edit  </a></td> 
				<td> <a href="<?php echo($this->getUrl('delete' , 'Admin' , ['id' => $admin->id ] )); ?>" > Delete </a> </td> 
			</tr>
		<?php endforeach ; ?>                     
	<?php endif ;  ?>

</table>	
		
	