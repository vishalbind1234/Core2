
<?php    $products = $this->getProduct();  /*print_r($products);  exit(); */  ?>

<button><a href="<?php  echo($this->getUrl('edit' , 'Product' , [] , true )); ?>" >  Add New  </a></button>

<table>


		<tr>
			<th>ID           </th>
			<th>Product Name </th>
			<th>Price Name   </th>
			<th>Quantity     </th>
			<th>Status       </th>
			<th>CreatedAt    </th>
			<th>UpdatedAt    </th>
			<th>SKU   		 </th>
			<th>Base Image    </th>
			<th>Thumb Image    </th>
			<th>Small Image    </th>
		</tr>

	<?php if(!$products): ?>
		<tr>
			<td colspan="7"><label> No Records Found . </label></td>
		</tr>
	<?php else :  ?>

		<?php foreach($products as $product) : ?>  <!-- -----------------for table data------------- -->
			<tr>
				<?php $thumRow = $product->getThum($product->id);   ?>                    
				<?php $baseRow = $product->getBase($product->id);   ?>                    
				<?php $smallRow = $product->getSmall($product->id); ?>   

				<td> <?php echo($product->id ); ?> </td>  
				<td> <?php echo($product->name ); ?> </td>  
				<td> <?php echo($product->price ); ?> </td>  
				<td> <?php echo($product->quantity ); ?> </td>  

				<?php foreach( $product->getStatus() as $key2 => $value2 ) :?>
					<?php if($product->status == $key2 ) : ?>
						<td> <option> <?php echo($value2); ?> </option> </td>
					<?php  endif  ; ?>
				<?php endforeach ;  ?>
				
				<td> <?php echo($product->createdAt ); ?> </td>  
				<td> <?php echo($product->updatedAt ); ?> </td>  
				<td> <?php echo($product->sku ); ?> </td>  
				
				<td>  <image class="img" src="<?php echo($baseRow->image); ?>" >  </td>  
				<td>  <image class="img" src="<?php echo($thumRow->image); ?>" >  </td>  
				<td>  <image class="img" src="<?php echo($smallRow->image); ?>" >  </td>  
				
				<td> <a href="<?php  echo($this->getUrl('edit' , 'Product' , ['id' => $product->id ])); ?>" > Edit  </a> </td>  
				<td> <a href="<?php  echo($this->getUrl('delete' , 'Product' , ['id' => $product->id ])); ?>" > Delete  </a> </td>  
				<td> <a href="<?php  echo($this->getUrl('media' , 'Product_Media' , ['id' => $product->id ])); ?>" > Media  </a> </td>  
			</tr>
		<?php endforeach ; ?>                     
	<?php endif ;  ?>

</table>	
