
<?php  $vendor = $this->getCurrentVendor();  /*print_r($vendor);  exit();*/ ?>
  
<form action="<?php  echo($this->getUrl('save' , 'Vendor' )); ?>" method="post" >


	<table style="border:3px solid black">

	<tr>
	<td><label for="id">Vendor Id  &nbsp</label></td>
	<td><input type="number" id="id" name="Person[id]" placeholder="enter id" value=<?php echo $val = (!$vendor) ? "" : ($vendor->id); ?>   readonly ></td>
	</tr>

	
	<tr>
	<td><label for="firstName">First Name  &nbsp</label></td>
	<td><input type="text" id="firstName" name="Person[firstName]" placeholder="enter firstName"   value=<?php echo $val = (!$vendor) ? "" : ($vendor->firstName); ?>   ></td>
	</tr>

	<tr>
	<td><label for="lastName">Last Name  &nbsp</label></td>
	<td><input type="text" id="lastName" name="Person[lastName]" placeholder="enter lastName"   value=<?php echo $val = (!$vendor) ? "" : ($vendor->lastName); ?>   ></td>
	</tr>

	
	<tr>
	<td><label for="email">Email  &nbsp</label></td>
	<td><input type="text" id="email" name="Person[email]" placeholder="enter email"   value=<?php echo $val = (!$vendor) ? "" : ($vendor->email); ?>   ></td>
	</tr>

	
	<tr>
	<td><label for="mobile"> Mobile  &nbsp</label></td>
	<td><input type="number" id="mobile" name="Person[mobile]" placeholder="enter mobile"   value=<?php echo $val = (!$vendor) ? "" : ($vendor->mobile); ?>  ></td>
	</tr>

	
	<tr>
	<td><label for="status">Person Status &nbsp</label></td>
	<td>
		<select name="Person[status]">
			<?php foreach ($vendor->getStatus() as $key => $value) : ?>
				<option value="<?php echo $val = (!$vendor) ? "" : ($key); ?>"  <?php if($vendor->status == $key){echo $val = (!$vendor) ? "" : ('selected');} ?> > <?php echo $val = (!$vendor) ? "" : ($value); ?> </option>
			<?php endforeach ; ?>
		</select>
	</td>
	</tr>

	<tr>
	<td><label for="createdAt">CreatedAt  &nbsp</label></td>
	<td><input type="date"  id="createdAt" name="Person[createdAt]" placeholder="createdAt"   value=<?php echo $val = (!$vendor) ? "" : ($vendor->createdAt); ?> ></td>
	</tr>

	<tr>
	<td><label >Address Id  &nbsp</label></td>
	<td><input type="number"     name="Address[aId]" placeholder="enter aId" value=<?php echo $val = (!$vendor) ? "" : ($vendor->aId); ?>   readonly ></td>
	</tr>


	<tr>
	<td><label >Vendor Id  &nbsp</label></td>
	<td><input type="number"  name="Address[vendorId]" placeholder="enter vendorId" value=<?php echo $val = (!$vendor) ? "" : ($vendor->vendorId); ?>   readonly ></td>
	</tr>


	<tr>
	<td><label for="country">Country  &nbsp</label></td>
	<td><input type="text" id="country" name="Address[country]" placeholder="enter country"   value=<?php echo $val = (!$vendor) ? "" : ($vendor->country); ?>   ></td>
	</tr>


	<tr>
	<td><label for="state"> State  &nbsp</label></td>
	<td><input type="text" id="state" name="Address[state]" placeholder="enter state"   value=<?php echo $val = (!$vendor) ? "" : ($vendor->state); ?>   ></td>
	</tr>


	<tr>
	<td><label for="city">City  &nbsp</label></td>
	<td><input type="text" id="city" name="Address[city]" placeholder="enter city"   value=<?php echo $val = (!$vendor) ? "" : ($vendor->city); ?>   ></td>
	</tr>

	<tr>
	<td><label >Pincode Id  &nbsp</label></td>
	<td><input type="number"  name="Address[pincode]" placeholder="enter pincode" value=<?php echo $val = (!$vendor) ? "" : ($vendor->pincode); ?>    ></td>
	</tr>
	
	


    </table>

	
	<button type="submit" value="submit"  > Save </button> 
	<button > <a href='<?php  echo($this->getUrl('grid' , 'Vendor' )); ?>'> Cancel </a> </button> 
	
	
</form>
    
