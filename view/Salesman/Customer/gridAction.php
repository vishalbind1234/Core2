
<?php   $salesmanCustomers = $this->getSalesmanCustomers();   /* print_r($salesmanCustomers);   exit(); */ ?>
<?php   $salesmanId = $this->getData('id');    ?>
<?php   $percentage = $this->getData('percentage');    ?>


<table>

	<tr>
		<th>ID          </th>
		<th>First Name  </th>
		<th>Last Name   </th>
		<th>Email       </th>
		<th>Mobile      </th>
		<th>CreatedAt   </th>
		<th>UpdatedAt   </th>
		<th>Salesman ID   </th>


	</tr>

	<?php if(!$salesmanCustomers): ?>
		<tr>
			<td colspan="8"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>
		 
		<form action="<?php echo($this->getUrl('save', 'Salesman_Customer', ['id' => $salesmanId ] )); ?>"  method="post"  >

			<?php foreach($salesmanCustomers as $customer) : ?>  <!-- -----------------for table data------------- -->
				<tr>
					<?php foreach($customer->getData() as $key => $value) : ?>

						<?php if($key == 'status'): ?>
							<td>
								<select>
									<?php foreach($customer->getStatus() as $key2 => $value2) : ?>

										<option <?php if($key2 == $value){echo('selected');} ?>  value="<?php echo($key2); ?>" > <?php echo($value2);  ?> </option>

									<?php endforeach; ?>
								</select>
							</td>
						<?php else : ?>
							<td> <?php echo($value); ?> </td>
						<?php endif ; ?>	

					<?php endforeach ; ?> 

					<td> <input type="checkbox" name="Salesman[customer][]"  <?php if($customer->salesmanId != -1){echo('checked');} ?> value="<?php echo($customer->id); ?>"> </td>  
					
					<td> <input type="checkbox" name="Salesman[reference][]" hidden checked value="<?php echo($customer->id); ?>"> </td>  

					<td> <a href="<?php echo($this->getUrl('grid', 'Salesman_Customer_Product', ['id' => $salesmanId , 'percentage' => $percentage , 'customerId' => $customer->id ] )); ?>" > Product </a> </td>  


				</tr>
			<?php endforeach ; ?>  

			<td> <input type="submit" > </td>     
		
		</form>

	<?php endif ;  ?>

</table>	
		
	