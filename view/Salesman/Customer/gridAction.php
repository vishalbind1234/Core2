
<?php   $salesmanCustomers = $this->getSalesmanCustomers();  /* echo "<pre>"; print_r($salesmanCustomers);   exit();*/  ?>


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
					<td> <?php echo $customer->id;  ?>  </td>
					<td> <?php echo $customer->firstName;  ?>  </td>
					<td> <?php echo $customer->lastName;  ?>  </td>
					<td> <?php echo $customer->email;  ?>  </td>
					<td> <?php echo $customer->mobile;  ?>  </td>
					<td> <?php echo $customer->createdAt;  ?>  </td>
					<td> <?php echo $customer->updatedAt;  ?>  </td>
					<td> <?php echo $customer->salesmanId;  ?>  </td>

					<td> <input type="checkbox" name="Salesman[customer][]"  <?php if($customer->salesmanId != -1){echo('checked');} ?> value="<?php echo($customer->id); ?>"> </td>  
					
					<input type="checkbox" name="Salesman[reference][]" hidden checked value="<?php echo($customer->id); ?>"> 

					<td> <a href="<?php echo($this->getUrl('grid', 'Salesman_Customer_Product', ['customerId' => $customer->id , 'percentage' => $this->percentage ] )); ?>" > Product </a> </td>  

				</tr>
			<?php endforeach ; ?>  

			<td> <input type="submit" > </td>     
		
		</form>

	<?php endif ;  ?>

</table>	
		
	