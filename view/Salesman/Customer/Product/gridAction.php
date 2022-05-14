
<?php   $products = $this->getProducts();    /*print_r($products);   exit();*/  ?>

<?php   $salesmanId =  $this->id;  			?>
<?php   $customerId =  $this->customerId;  	?>
<?php   $percentage =  $this->percentage;   ?>


<table>

	<tr>
		<th>Product ID 	     </th>
		<th>Name  			 </th>
		<th>Sku   			 </th>
		<th>Product Price    </th>
		<th>Entity Id		 </th>
		<th>Salesman Price   </th>
		<th>Customer Price   </th>

	</tr>

	<?php if(!$products): ?>
		<tr>
			<td colspan="6"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>
		 
		<form action="<?php echo($this->getUrl('save', 'Salesman_Customer_Product'  , ['customerId' => $this->customerId] )); ?>"  method="post"  >

			<?php foreach($products as $product) : ?>   <!-- -----------------for table data------------- -->
				<tr>
					<?php $bool = true; ?>
					<td> <input type="text"  value="<?php echo($product->id ); ?>" >  </td>  
					<td> <input type="text"  value="<?php echo($product->name ); ?>" >  </td>  
					<td> <input type="text"  value="<?php echo($product->sku ); ?>" >  </td>  
					<td> <input type="text" name="Product[productPrice][<?php echo $product->id ; ?>]" value="<?php echo( ($product->price) ); ?>" >  </td> 
					
					<?php foreach($this->getCustomerPrice() as $key => $value) : ?>
						<?php if($value->productId == $product->id) : ?>
							<td> <input type="text" name="Product[entityId][<?php echo $product->id ; ?>]" value="<?php echo $value->entityId; ?>" >  </td> 
							<td> <input type="text" name="Product[salesmanPrice][<?php echo $product->id ; ?>]" value="<?php echo ($product->price - $product->price*($this->percentage/100)); ?>" >  </td> 
							<td> <input type="text" name="Product[customerPrice][<?php echo $product->id ; ?>]" value="<?php echo $value->customerPrice; ?>" >  </td>
							<?php $bool = false; ?>
						<?php endif ; ?>
					<?php endforeach ; ?>

					<?php if($bool) : ?>
						<td> <input type="text" name="Product[entityId][<?php echo $product->id ; ?>]" value="" >  </td> 
						<td> <input type="text" name="Product[salesmanPrice][<?php echo $product->id ; ?>]" value="<?php echo ($product->price - $product->price*($this->percentage/100)); ?>" >  </td> 
						<td> <input type="text" name="Product[customerPrice][<?php echo $product->id ; ?>]" value="" >  </td>
					<?php endif; ?>

				</tr>
			<?php endforeach ; ?>  


			<td> <a href="<?php echo($this->getUrl('grid', 'Salesman')); ?>"> Cancel </a>  </td>  
			<td> <input type="submit" > </td>     
		
		</form>

	<?php endif ;  ?>

</table>	
		
	
