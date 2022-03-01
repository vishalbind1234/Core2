
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
		<td><input type="number" id="id" name="Salesman[id]" placeholder="enter id" value=<?php echo $val = (!$salesman) ? "" : ($salesman->id); ?>   readonly ></td>
		</tr>

		
		<tr>
		<td><label for="firstName">First Name  &nbsp</label></td>
		<td><input type="text" id="firstName" name="Salesman[firstName]" placeholder="enter firstName"   value=<?php echo $val = (!$salesman) ? "" : ($salesman->firstName); ?>   ></td>
		</tr>

		<tr>
		<td><label for="lastName">Last Name  &nbsp</label></td>
		<td><input type="text" id="lastName" name="Salesman[lastName]" placeholder="enter lastName"   value=<?php echo $val = (!$salesman) ? "" : ($salesman->lastName); ?>   ></td>
		</tr>

		
		<tr>
		<td><label for="email">Email  &nbsp</label></td>
		<td><input type="text" id="email" name="Salesman[email]" placeholder="enter email"   value=<?php echo $val = (!$salesman) ? "" : ($salesman->email); ?>   ></td>
		</tr>

		
		<tr>
		<td><label for="mobile"> Mobile  &nbsp</label></td>
		<td><input type="number" id="mobile" name="Salesman[mobile]" placeholder="enter mobile"   value=<?php echo $val = (!$salesman) ? "" : ($salesman->mobile); ?>  ></td>
		</tr>

		
		<tr>
		<td><label for="status">Salesman Status &nbsp</label></td>
		<td>
			<select name="Salesman[status]">
				<?php foreach ($this->getStatus() as $key => $value) : ?>
					<option value="<?php echo $val = (!$salesman) ? "" : ($key); ?>"  <?php if($salesman->status == $key){echo $val = (!$salesman) ? "" : ('selected');} ?> > <?php echo $val = (!$salesman) ? "" : ($value); ?> </option>
				<?php endforeach ; ?>
			</select>
		</td>
		</tr>

		<tr>
		<td><label for="createdAt">CreatedAt  &nbsp</label></td>
		<td><input type="date"  id="createdAt" name="Salesman[createdAt]" placeholder="createdAt"   value=<?php echo $val = (!$salesman) ? "" : ($salesman->createdAt); ?> ></td>
		</tr>

		
	    </table>

		
		<button type="submit" value="submit"  > Save </button> 
		<button > <a href='<?php  echo($this->getUrl('grid' , 'Salesman' )); ?>'> Cancel </a> </button> 
		
		
	</form>
    
</body>

</html>
