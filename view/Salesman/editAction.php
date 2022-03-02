
<?php  $salesman = $this->getCurrentSalesman();  /*print_r($salesman);  exit();*/ ?>

<!DOCTYPE html>
<html lang="en" >
<head>

</head>

<body>
	  
	<form action="<?php  echo($this->getUrl('save' , 'Salesman' )); ?>" method="post" >


		<table style="border:3px solid black">

		<tr>
		<td><label for="id">Salesman Id  &nbsp</label></td>
		<td><input type="number" id="id" name="Salesman[id]" placeholder="enter id" value=<?php echo ($salesman->id); ?>   readonly ></td>
		</tr>

		
		<tr>
		<td><label for="firstName">First Name  &nbsp</label></td>
		<td><input type="text" id="firstName" name="Salesman[firstName]" placeholder="enter firstName"   value=<?php echo ($salesman->firstName); ?>   ></td>
		</tr>

		<tr>
		<td><label for="lastName">Last Name  &nbsp</label></td>
		<td><input type="text" id="lastName" name="Salesman[lastName]" placeholder="enter lastName"   value=<?php echo ($salesman->lastName); ?>   ></td>
		</tr>

		
		<tr>
		<td><label for="email">Email  &nbsp</label></td>
		<td><input type="text" id="email" name="Salesman[email]" placeholder="enter email"   value=<?php echo ($salesman->email); ?>   ></td>
		</tr>

		
		<tr>
		<td><label for="mobile"> Mobile  &nbsp</label></td>
		<td><input type="number" id="mobile" name="Salesman[mobile]" placeholder="enter mobile"   value=<?php echo ($salesman->mobile); ?>  ></td>
		</tr>

		
		<tr>
		<td><label for="status">Salesman Status &nbsp</label></td>
		<td>
			<select name="Salesman[status]">
				<?php foreach ($salesman->getStatus() as $key => $value) : ?>
					<option value="<?php echo ($key); ?>"  <?php if($salesman->status == $key){echo ('selected');} ?> > <?php echo ($value); ?> </option>
				<?php endforeach ; ?>
			</select>
		</td>
		</tr>

		<tr>
		<td><label for="createdAt">CreatedAt  &nbsp</label></td>
		<td><input type="date"  id="createdAt" name="Salesman[createdAt]" placeholder="createdAt"   value=<?php echo ($salesman->createdAt); ?> ></td>
		</tr>

		
	    </table>

		
		<button type="submit" value="submit"  > Save </button> 
		<button > <a href='<?php  echo($this->getUrl('grid' , 'Salesman' )); ?>'> Cancel </a> </button> 
		
		
	</form>
    
</body>

</html>
