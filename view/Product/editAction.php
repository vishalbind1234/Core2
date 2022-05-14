
<?php  $product = $this->getCurrentProduct();               /*echo "<pre>";  print_r($product); exit(); */          ?>
<?php  $categoryProduct = $product->getCategoryProduct();  /*echo "<pre>";  print_r($categoryProduct); exit();*/ ?>
<?php  $allCategories = $this->getAllCategories();          /*echo "<pre>";  print_r($allCategories); exit(); */    ?>
	  
<form action="<?php  echo($this->getUrl('save' , 'Product' , ['productId' => $product->id] )); ?>" method="post" >

	<table>
		<tr>
			<td>
				
				<table style="border:3px solid black">

					<tr>
					<td><label for="id">Product Id  &nbsp</label></td>
					<td><input type="number" id="id" name="Product[id]" readonly placeholder="enter id" value="<?php echo $product->id; ?>" <?php if(!$product->id){echo "hidden";} ?> ></td>
					</tr>

					
					<tr>
					<td><label for="name">Product Name  &nbsp</label></td>
					<td><input type="text" id="name" name="Product[name]" placeholder="enter name"   value=<?php echo ($product->name); ?>   ></td>
					</tr>

					
					<tr>
					<td><label for="price">Product Price  &nbsp</label></td>
					<td><input type="number" step="0.01" id="price" name="Product[price]" placeholder="enter price"   value=<?php echo ($product->price); ?>   ></td>
					</tr>

					<tr>
					<td><label for="discount"> Discount  &nbsp</label></td>
					<td><input type="number" step="0.0001" id="discount" name="Product[discount]" placeholder="enter discount"   value=<?php echo ($product->discount); ?>   ></td>
					</tr>

					<tr>
					<td><label for="discountMode"> Discount Mode  &nbsp</label></td>
					<td><input type="text"  id="discountMode" name="Product[discountMode]" placeholder="enter discountMode"   value=<?php echo ($product->discountMode); ?>   ></td>
					</tr>

					<tr>
					<td><label for="taxPercentage"> Tax Percentage &nbsp</label></td>
					<td><input type="number" step="0.0001" id="taxPercentage" name="Product[taxPercentage]" placeholder="enter taxPercentage"   value=<?php echo ($product->taxPercentage); ?>   ></td>
					</tr>

					
					<tr>
					<td><label for="quantity">Product Quantity  &nbsp</label></td>
					<td><input type="number" id="quantity" name="Product[quantity]" placeholder="enter quantity"   value=<?php echo ($product->quantity); ?>  ></td>
					</tr>

					
					<tr>
					<td><label for="status">Product Status &nbsp</label></td>
					<td>
						<select name="Product[status]">
							<?php foreach ($product->getStatus() as $key => $value) : ?>
								<option value="<?php echo($key); ?>"  <?php if($product->status == $key){echo('selected');} ?> > <?php echo($value); ?> </option>
							<?php endforeach ; ?>
						</select>
					</td>
					</tr>

					<tr>
					<td><label for="createdAt">CreatedAt  &nbsp</label></td>
					<td><input type="date"  id="createdAt" name="Product[createdAt]" placeholder="createdAt"   value=<?php echo ($product->createdAt); ?> ></td>
					</tr>

					<tr>
					<td> <button type="submit"   > Save </button> </td>
					<td> <button > <a href='<?php  echo($this->getUrl('grid' , 'Product' )); ?>'> Cancel </a> </button> </td>
					</tr>

			    </table>

			</td>

			<td>
				<table>
					<?php $array = [] ;  ?>	 
					<?php foreach ($categoryProduct as $key => $value)  : ?>
						<?php array_push($array, $value->categoryId); ?>
						<input type="checkbox" name="Product[reference][<?php echo($value->entityId); ?>]"  hidden value="<?php echo($value->categoryId); ?>" checked >  
					<?php endforeach ; ?>

					<?php foreach( $allCategories as $key => $category) : ?>
						<tr>
							<td> <input type="checkbox" name="Product[category][]" <?php if(in_array($category->id, $array)){echo('checked');} ?>  value="<?php echo($category->id) ; ?>" > <?php echo $this->wholePathName($category->id); ?> </td>
						</tr>
					<?php endforeach ; ?>
				</table>
			</td>

		</tr>
	</table>
</form>
    
