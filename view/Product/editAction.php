<?php  date_default_timezone_set('Asia/Kolkata');    ?>
<?php  $products = $this->getCurrentProduct();             ?>
<!DOCTYPE html>
<html lang="en" >
<head>

</head>

<body>
	  
	<form action="index.php?a=save&c=Product" method="post" >


		<table style="border:3px solid black">

		<tr>
		<td><label for="id">Product Id  &nbsp</label></td>
		<td><input type="number" id="id" name="Product[id]" placeholder="enter id" value=<?php echo($products['id']); ?>   readonly ></td>
		</tr>

		
		<tr>
		<td><label for="name">Product Name  &nbsp</label></td>
		<td><input type="text" id="name" name="Product[name]" placeholder="enter name"   value=<?php echo($products['name']); ?>   ></td>
		</tr>

		
		<tr>
		<td><label for="price">Product Price  &nbsp</label></td>
		<td><input type="number" step="0.01" id="price" name="Product[price]" placeholder="enter price"   value=<?php echo($products['price']); ?>   ></td>
		</tr>

		
		<tr>
		<td><label for="quantity">Product Quantity  &nbsp</label></td>
		<td><input type="number" id="quantity" name="Product[quantity]" placeholder="enter quantity"   value=<?php echo($products['quantity']); ?>  ></td>
		</tr>

		
		<tr>
		<td><label for="status">Product Status( either 1 or 2 )  &nbsp</label></td>
		<td><input type="number"  id="status" name="Product[status]" placeholder="status" min="1" max="2" style="width:3cm; " value=<?php echo($products['status']); ?>  ></td>

		</tr>

		<tr>
		<td><label for="createdAt">CreatedAt  &nbsp</label></td>
		<td><input type="date"  id="createdAt" name="Product[createdAt]" placeholder="createdAt"   value=<?php echo($products['createdAt']); ?> ></td>
		</tr>

		
		<tr>
		<td><label for="updatedAt"> UpdatedAt  &nbsp</label></td>
		<td><input type="date"  id="updatedAt" name="Product[updatedAt]" placeholder="updatedAt"  value=<?php echo( date('Y-m-d') ); ?>   readonly > </td>
		</tr>

	    </table>

		<br>
		<button type="submit"   > Save </button> 
		<button > <a href='index.php?a=grid&c=Product'> Cancel </a> </button> 
		<br>
		
	</form>
    
</body>

</html>
