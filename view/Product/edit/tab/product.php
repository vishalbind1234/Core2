
<?php  $product = $this->getCurrentProduct();               /*echo "<pre>";  print_r($product); exit(); */          ?>
<?php  $categoryProduct = $product->getCategoryProduct();  /*echo "<pre>";  print_r($categoryProduct); exit();*/    ?>
<?php  $allCategories = $this->getAllCategories();          /*echo "<pre>";  print_r($allCategories); exit(); */    ?>

<table>
	<tr>
		<td>
			
			<table>

				<tr>
				<td><label for="id">Product Id  &nbsp</label></td>
				<td><input type="number" id="id" name="Product[item][id]" readonly placeholder="enter id" value="<?php echo $product->id; ?>" <?php if(!$product->id){echo "hidden";} ?> ></td>
				</tr>

				
				<tr>
				<td><label for="name">Product Name  &nbsp</label></td>
				<td><input type="text" id="name" name="Product[item][name]" placeholder="enter name"   value=<?php echo ($product->name); ?>   ></td>
				</tr>

				
				<tr>
				<td><label for="price">Product Price  &nbsp</label></td>
				<td><input type="number" step="0.01" id="price" name="Product[item][price]" placeholder="enter price"   value=<?php echo ($product->price); ?>   ></td>
				</tr>

				<tr>
				<td><label for="discount"> Discount  &nbsp</label></td>
				<td><input type="number" step="0.0001" id="discount" name="Product[item][discount]" placeholder="enter discount"   value=<?php echo ($product->discount); ?>   ></td>
				</tr>

				<tr>
				<td><label for="discountMode"> Discount Mode  &nbsp</label></td>
				<td><input type="text"  id="discountMode" name="Product[item][discountMode]" placeholder="enter discountMode"   value=<?php echo ($product->discountMode); ?>   ></td>
				</tr>

				<tr>
				<td><label for="taxPercentage"> Tax Percentage &nbsp</label></td>
				<td><input type="number" step="0.0001" id="taxPercentage" name="Product[item][taxPercentage]" placeholder="enter taxPercentage"   value=<?php echo ($product->taxPercentage); ?>   ></td>
				</tr>

				
				<tr>
				<td><label for="quantity">Product Quantity  &nbsp</label></td>
				<td><input type="number" id="quantity" name="Product[item][quantity]" placeholder="enter quantity"   value=<?php echo ($product->quantity); ?>  ></td>
				</tr>

				
				<tr>
				<td><label for="status">Product Status &nbsp</label></td>
				<td>
					<select name="Product[item][status]">
						<?php foreach ($product->getStatus() as $key => $value) : ?>
							<option value="<?php echo($key); ?>"  <?php if($product->status == $key){echo('selected');} ?> > <?php echo($value); ?> </option>
						<?php endforeach ; ?>
					</select>
				</td>
				</tr>

				<tr>
				<td><label for="createdAt">CreatedAt  &nbsp</label></td>
				<td><input type="date"  id="createdAt" name="Product[item][createdAt]" placeholder="createdAt" value=<?php echo ($product->createdAt); ?> ></td>
				</tr>

				

		    </table>

		</td>

		<td>
			<table>
				<?php $array = [] ;  ?>	 
				<?php foreach ($categoryProduct as $key => $value)  : ?>
					<?php array_push($array, $value->categoryId); ?>
					<tr>
						<td><input type="checkbox" name="Product[reference][<?php echo($value->entityId); ?>]" hidden  value="<?php echo($value->categoryId); ?>" checked > </td>
					</tr>
				<?php endforeach ; ?>

			</table>
		</td>
		<td>
			<table>
				<?php foreach( $allCategories as $key => $category) : ?>
					<tr>
						<td> <input type="checkbox" name="Product[category][]" <?php if(in_array($category->id, $array)){echo('checked');} ?>  value="<?php echo($category->id) ; ?>" > <?php echo $this->wholePathName($category->id); ?> </td>
					</tr>
				<?php endforeach ; ?>
			</table>
		</td>

	</tr>

	<tr>
		<td><button type="button" id="submit-button" value="<?php echo $this->getUrl('save','Product'); ?>"> Save </button></td>
		<td><button type="button" id="cancel-button" value="<?php echo $this->getUrl('index','Product'); ?>" > Cancel </button></td>
	</tr>
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
	  

