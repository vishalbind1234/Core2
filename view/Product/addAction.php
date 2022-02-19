
<!DOCTYPE html>
<html lang="en" >
<head>
	

</head>

<body>
	  
	<form action="index.php?a=save&c=Product" method="post" >

			
		<table style="border:3px solid black">

		<tr>
		<td><label for="name">Product Name  &nbsp</label></td>
		<td><input type="text" id="name" name=Product[name] placeholder="enter name"></td>
		</tr>

		
		<tr>
		<td><label for="price">Product Price  &nbsp</label></td>
		<td><input type="number" step="0.01" id="price" name=Product[price] placeholder="enter price"></td>
		</tr>

		
		<tr>
		<td><label for="quantity">Product Quantity  &nbsp</label></td>
		<td><input type="number" id="quantity" name=Product[quantity] placeholder="enter quantity"></td>
		</tr>

		
		<tr>
		<td><label for="status">Product Status( either 1 or 2 )  &nbsp</label></td>
		<td><input type="number"  id="status" name=Product[status] placeholder="status" min="1" max="2" style="width:3cm; " ></td>

		</tr>

		</tr>

		<tr>
		<td><label for="createdAt">CreatedAt  &nbsp</label></td>
		<td><input type="date"  id="createdAt" name=Product[createdAt] placeholder="createdAt" ></td>
		</tr>

		
		<tr>
		<td><label for="updatedAt"> UpdatedAt  &nbsp</label></td>
		<td><input type="date"  id="updatedAt" name=Product[updatedAt]  placeholder="updatedAt" value="" readonly > </td>
		</tr>

	    </table>

		<br>
		<button type="submit"  value="submit"> Save </button> 
		<button > <a href='index.php?a=grid&c=Product'> Cancel </a> </button> 
		<br>
			
	</form>


</body>

</html>
