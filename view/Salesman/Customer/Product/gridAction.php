
<?php   $salesmanCustomerProducts = $this->getSalesmanCustomerProducts();    /*print_r($salesmanCustomerProducts);   exit();*/  ?>

<?php   $salesmanId =  $this->getData('id');  ?>
<?php   $customerId =  $this->getData('customerId');  ?>
<?php   $percentage =  $this->getData('percentage');        ?>


<table>

	<tr>
		<th>Product ID 	     </th>
		<th>Name  			 </th>
		<th>Sku   			 </th>
		<th>Product Price    </th>
		<th>Salesman Price   </th>
		<th>Customer Price   </th>

	</tr>

	<?php if(!$salesmanCustomerProducts): ?>
		<tr>
			<td colspan="6"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>
		 
		<form action="<?php echo($this->getUrl('save', 'Salesman_Customer_Product' )); ?>"  method="post"  >

			<?php foreach($salesmanCustomerProducts as $product) : ?>  <!-- -----------------for table data------------- -->
				<tr>

					<?php  $row = $this->getPrice($salesmanId , $customerId , $product->id ); 	?>
					<?php if( $row->entityId ) : ?>
				   		 <input type="text" name="Product[entityId][<?php echo( $product->id ); ?>]" hidden  value="<?php echo( $row->entityId ); ?>" >
					<?php endif ; ?>

					<td> <input type="text"  value="<?php echo($product->id ); ?>" >  </td>  
					<td> <input type="text"  value="<?php echo($product->name ); ?>" >  </td>  
					<td> <input type="text"  value="<?php echo($product->sku ); ?>" >  </td>  
					<td> <input type="text" name="Product[productPrice][<?php echo( $product->id ); ?>]" value="<?php echo( ($product->price) ); ?>" >  </td>  
					<td> <input type="text" name="Product[salesmanPrice][<?php echo( $product->id ); ?>]" value="<?php echo( ($product->price)*((100 - $percentage)/100) ); ?>" >  </td> 


					<td> <input type="text" name="Product[customerPrice][<?php echo( $product->id ); ?>]"  value="<?php echo( $row->customerPrice ); ?>" >  </td>
					<input type="text" name="Product[salesmanId]" hidden  value="<?php echo( $salesmanId ); ?>" > 
					<input type="text" name="Product[customerId]" hidden  value="<?php echo( $customerId ); ?>" > 

				</tr>
			<?php endforeach ; ?>  


			<td> <a href="<?php echo($this->getUrl('grid', 'Salesman')); ?>"> Cancel </a>  </td>  
			<td> <input type="submit" > </td>     
		
		</form>

	<?php endif ;  ?>

</table>	
		
	
