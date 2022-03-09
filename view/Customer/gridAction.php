<?php   $customers = $this->getCustomer();    /*print_r($customers);   exit();*/  ?>

<button><a href="<?php echo($this->getUrl('edit'  , 'Customer' , [] , true)); ?>"> Add New </a></button>

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

	<?php if(!$customers): ?>
		<tr>
			<td colspan="16"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>
		
		<?php foreach($customers as $customer) : ?>  <!-- -----------------for table data------------- -->
			<tr>
				<?php foreach($customer->getData() as $key => $value) : ?>

					<td> <?php echo($value);  ?> </td>

				<?php endforeach ; ?>        

				<td> <a href="<?php echo($this->getUrl('edit' , 'Customer' , ['id' => $customer->id ])); ?>" > Edit  </a> </td>  
				<td> <a href="<?php echo($this->getUrl('delete' , 'Customer' , ['id' => $customer->id ])); ?>" > Delete </a> </td>  
			</tr>
		<?php endforeach ; ?>                     
	<?php endif ;  ?>

</table>	
		
