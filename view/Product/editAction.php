
<?php  $products = $this->getCurrentProduct();   ?>
<!DOCTYPE html>
<html lang="en" >
<head>

</head>

<body>
	  
	<form action="<?php  echo($this->getUrl('save' , 'Product' )); ?>" method="post" >


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

		
	

	    </table>

		<br>
		<button type="submit"   > Save </button> 
		<button > <a href='<?php  echo($this->getUrl('grid' , 'Product' )); ?>'> Cancel </a> </button> 
		<br>
		
	</form>
    
</body>

</html>
