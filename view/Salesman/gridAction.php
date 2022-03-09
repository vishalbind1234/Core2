
<?php   $salesmans = $this->getSalesman();   /* print_r($salesmans);   exit(); */ ?>

<button><a href="<?php echo($this->getUrl('edit'  , 'Salesman' , [] , true)); ?>"> Add New </a></button>

<table>

	<tr>
		<th>ID          </th>
		<th>First Name  </th>
		<th>Last Name   </th>
		<th>Email       </th>
		<th>Mobile      </th>
		<th>Status      </th>
		<th>CreatedAt   </th>
		<th>UpdatedAt   </th>
		<th>Percentage   </th>


	</tr>

	<?php if(!$salesmans): ?>
		<tr>
			<td colspan="8"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>
		
		<?php foreach($salesmans as $salesman) : ?>  <!-- -----------------for table data------------- -->
			<tr>
				<?php foreach($salesman->getData() as $key => $value) : ?>

					<?php if($key == 'status'): ?>
						<td>
							<select>
								<?php foreach($this->getStatus() as $key2 => $value2) : ?>

									<option <?php if($key2 == $value){echo('selected');} ?>  value="<?php echo($key2); ?>" > <?php echo($value2);  ?> </option>

								<?php endforeach; ?>
							</select>
						</td>
					<?php else : ?>
						<td> <?php echo($value); ?> </td>
					<?php endif ; ?>	

				<?php endforeach ; ?>        

				<td> <a href="<?php echo($this->getUrl('edit' , 'Salesman' , ['id' => $salesman->id ])); ?>" > Edit  </a> </td>  
				<td> <a href="<?php echo($this->getUrl('delete' , 'Salesman' , ['id' => $salesman->id ])); ?>" > Delete </a> </td>  
				<td> <a href="<?php echo($this->getUrl('grid' , 'Salesman_Customer' , ['id' => $salesman->id , 'percentage' => $salesman->percentage] )); ?>" > Manage Customers </a> </td>  

			</tr>
		<?php endforeach ; ?>                     
	<?php endif ;  ?>

</table>	
		
	