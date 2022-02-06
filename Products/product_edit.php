
<!DOCTYPE html>
<html lang="en" >
<head>
<?php

	include_once("../Adapter.php");

	$adapter = new Adapter();

	$result = $adapter->get("select * from ProductGrid where id = " . $_GET['id'] );
	$res = $result->fetchAll(PDO::FETCH_ASSOC);

	date_default_timezone_set('Asia/Kolkata');
	
    


?>	

</head>

<body>
	  
	<form action="product_save.php" method="post" >


		<table style="border:3px solid black">

		<tr>
		<td><label for="p_id">Product Id  &nbsp</label></td>
		<td><input type="number" id="p_id" name="p_id" placeholder="enter id" value=<?php echo($res[0]['id']); ?>   readonly ></td>
		</tr>

		
		<tr>
		<td><label for="p_name">Product Name  &nbsp</label></td>
		<td><input type="text" id="p_name" name="p_name" placeholder="enter name"   value=<?php echo($res[0]['name']); ?>   ></td>
		</tr>

		
		<tr>
		<td><label for="p_price">Product Price  &nbsp</label></td>
		<td><input type="number" step="0.01" id="p_price" name="p_price" placeholder="enter price"   value=<?php echo($res[0]['price']); ?>   ></td>
		</tr>

		
		<tr>
		<td><label for="p_quantity">Product Quantity  &nbsp</label></td>
		<td><input type="number" id="p_quantity" name="p_quantity" placeholder="enter quantity"   value=<?php echo($res[0]['quantity']); ?>  ></td>
		</tr>

		
		<tr>
		<td><label for="p_status">Product Status( either 1 or 2 )  &nbsp</label></td>
		<td><input type="number"  id="p_status" name="p_status" placeholder="status" min="1" max="2" style="width:3cm; " value=<?php echo($res[0]['status']); ?>  ></td>

		</tr>

		<tr>
		<td><label for="p_createdAt">CreatedAt  &nbsp</label></td>
		<td><input type="date"  id="p_createdAt" name="p_createdAt" placeholder="p_createdAt"   value=<?php echo($res[0]['createdAt']); ?> ></td>
		</tr>

		
		<tr>
		<td><label for="p_updatedAt"> UpdatedAt  &nbsp</label></td>
		<td><input type="date"  id="p_updatedAt" name="p_updatedAt" placeholder="p_updatedAt"  value=<?php echo( date('Y-m-d') ); ?>   readonly > </td>
		</tr>

	    </table>

		<br>
		<button type="submit" name="submit" value="submit"> Save </button> 
		<button > <a href='product_grid.php'> Cancel </a> </button> 
		<br>
		
	</form>
    
</body>

</html>
