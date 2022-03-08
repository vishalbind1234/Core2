
<?php  $products = $this->getCurrentProduct();   ?>
<!DOCTYPE html>
<html lang="en" >
<head>

</head>

<body>
	  
	<form action="<?php  echo($this->getUrl('save' , 'Product' , ['productId' => $products->id] )); ?>" method="post" >

		<table>
			<tr>
				<td>
					
					<table style="border:3px solid black">

						<tr>
						<td><label for="id">Product Id  &nbsp</label></td>
						<td><input type="number" id="id" name="Product[id]" placeholder="enter id" value=<?php echo ($products->id); ?>   readonly ></td>
						</tr>

						
						<tr>
						<td><label for="name">Product Name  &nbsp</label></td>
						<td><input type="text" id="name" name="Product[name]" placeholder="enter name"   value=<?php echo ($products->name); ?>   ></td>
						</tr>

						
						<tr>
						<td><label for="price">Product Price  &nbsp</label></td>
						<td><input type="number" step="0.01" id="price" name="Product[price]" placeholder="enter price"   value=<?php echo ($products->price); ?>   ></td>
						</tr>

						
						<tr>
						<td><label for="quantity">Product Quantity  &nbsp</label></td>
						<td><input type="number" id="quantity" name="Product[quantity]" placeholder="enter quantity"   value=<?php echo ($products->quantity); ?>  ></td>
						</tr>

						
						<tr>
						<td><label for="status">Product Status &nbsp</label></td>
						<td>
							<select name="Product[status]">
								<?php foreach ($products->getStatus() as $key => $value) : ?>
									<option value="<?php echo($key); ?>"  <?php if($products->status == $key){echo('selected');} ?> > <?php echo($value); ?> </option>
								<?php endforeach ; ?>
							</select>
						</td>
						</tr>

						<tr>
						<td><label for="createdAt">CreatedAt  &nbsp</label></td>
						<td><input type="date"  id="createdAt" name="Product[createdAt]" placeholder="createdAt"   value=<?php echo ($products->createdAt); ?> ></td>
						</tr>

						<tr>
						<td> <button type="submit"   > Save </button> </td>
						<td> <button > <a href='<?php  echo($this->getUrl('grid' , 'Product' )); ?>'> Cancel </a> </button> </td>
						</tr>

				    </table>

				</td>

				<td>
					<table>
						<?php 

							$checkedCategories = $this->getCheckedCategories() ; 
							$array = [] ;  
						?>

						<?php foreach ($checkedCategories as $key => $value)  : ?>
						
							<?php array_push($array, $value->categoryId); ?>
						  	<!-- $array[$value->entityId] =  $value->categoryId; -->
						  

							<tr>
								<td> <input type="checkbox" name="Product[reference][<?php echo($value->entityId); ?>]"  hidden value="<?php echo($value->categoryId); ?>" checked >  </td>
							</tr>
					 
						<?php endforeach ; ?>

						<?php foreach( $this->getAllCategories() as $key => $value) : ?>
							<tr>
								<td> <input type="checkbox" name="Product[category][]" <?php if(in_array($value->id, $array)){echo('checked');} ?>  value="<?php echo($value->id) ; ?>" > <?php echo($value->name) ; ?> </td>
							</tr>

							
												
						<?php endforeach ; ?>
					</table>
				</td>

			</tr>
		</table>
	</form>
    
</body>

</html>
