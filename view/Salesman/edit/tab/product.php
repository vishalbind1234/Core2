
<?php   $products = $this->getProducts();    /*print_r($products);   exit();*/  ?>


<table>

	<tr>
		<th>Product ID 	     </th>
		<th>Name  			 </th>
		<th>Sku   			 </th>
		<th>Product Price    </th>
		<th>Salesman Price   </th>
		<th>Customer Price   </th>

	</tr>

	<?php if(!$products): ?>
		<tr>
			<td colspan="6"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>
		 
		<?php foreach($products as $product) : ?>   <!-- -----------------for table data------------- -->
			<tr>

				<td> <?php echo($product->id );   ?>   </td>  
				<td> <?php echo($product->name ); ?>   </td>  
				<td> <?php echo($product->sku );  ?>   </td>  

				<td> <input type="text" name="Product[productPrice][<?php echo $product->id ; ?>]" value="<?php echo $product->price ; ?>" >  </td> 
				<td> <input type="text" readonly name="Product[salesmanPrice][<?php echo $product->id ; ?>]" value="<?php echo ($product->price - $product->price*($this->percentage/100)); ?>" >  </td> 
				<td> <input type="text" name="Product[customerPrice][<?php echo $product->id ; ?>]" value="<?php echo $this->getPriceRow($product->id)->customerPrice; ?>" >  </td>

				<td> <input type="text" name="Product[entityId][<?php echo $product->id ; ?>]" hidden value="<?php echo $this->getPriceRow($product->id)->entityId; ?>" >  </td> 
			</tr>
		<?php endforeach ; ?>  

		<tr>
			<td><button type="button" id="submit-button" value="<?php echo $this->getUrl('save','Salesman_Customer_Product'); ?>"> Save </button></td>
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
	
	
</script>
		
	