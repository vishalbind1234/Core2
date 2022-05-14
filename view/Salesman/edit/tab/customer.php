
<?php   $salesmanCustomers = $this->getSalesmanCustomers();  /* echo "<pre>"; print_r($salesmanCustomers);   exit();*/  ?>


<table class="table" >

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

				<td> <button type="button" class="product-price"  value="<?php echo($this->getUrl('edit', 'Salesman', ['customerId' => $customer->id , 'tab' => 'product'] )); ?>" > Products price </button> </td>  

			</tr>
		<?php endforeach ; ?>  
		<tr>
			<td><button type="button" id="submit-button" value="<?php echo $this->getUrl('save','Salesman_Customer'); ?>"> Save </button></td>
			<td><button type="button" id="cancel-button" value="<?php echo $this->getUrl('index','Salesman'); ?>" > Cancel </button></td>
		</tr>
		
	<?php endif ;  ?>

</table>	

<script type="text/javascript">
	
	jQuery("#cancel-button").click(function(){

		var url = jQuery(this).val();
		admin.setUrl(url).load();

	});

	jQuery("#submit-button").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.setData(jQuery("#edit-form").serializeArray());
		admin.load();

	});

	jQuery(".product-price").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.load();

	});

	
	
</script>
		
	