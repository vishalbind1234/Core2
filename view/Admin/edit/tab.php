
<?php   $admin = $this->getCurrentAdmin();   ?>

<table>

	<tr>
		<td colspan="2"><label> Admin &nbsp </label></td>
		
	</tr>

	<tr>
		<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
		<td><input type="number" name=Admin[id] value=<?php echo( $admin->id); ?>  readonly ></td>
	</tr>
	<tr>
		<td><label> First Name &nbsp </label></td>
		<td><input type="text" name=Admin[firstName]  value=<?php echo( $admin->firstName); ?>   ></td>
	</tr>
	<tr>
		<td><label> Last Name &nbsp </label></td>
		<td><input type="text" name=Admin[lastName]  value=<?php echo( $admin->lastName); ?>   ></td>
	</tr>
	<tr>
		<td><label> Email &nbsp </label></td>
		<td><input type="text" name=Admin[email]  value=<?php echo( $admin->email); ?>   ></td>
	</tr>

	<tr>
		<td><label> Password &nbsp </label></td>
		<td><input type="Password" name=Admin[password] value=<?php echo( $admin->password); ?> ></td>
	</tr>


	<tr>
	<td><label for="status"> Status &nbsp</label></td>
	<td>
		<select name="Admin[status]">
			<?php foreach ($admin->getStatus() as $key => $value) : ?>
				<option value="<?php echo($key); ?>"  <?php if($admin->status == $key){echo('selected');} ?> > <?php echo($value); ?> </option>
			<?php endforeach ; ?>
		</select>
	</td>
	</tr>
	
	<tr>
		<td><label> CreatedAt &nbsp </label></td>
		<td><input type="date" name=Admin[createdAt]  value=<?php echo( $admin->createdAt); ?>   ></td>
	</tr>
	<tr>
		<td><label> UpdatedAt &nbsp </label></td>
		<td><input type="date" name=Admin[updatedAt]  value=""  hidden ></td> 
	</tr>

</table>

<button type="submit" name="submit" value="submit"> Save </button>
<button> <a href="<?php echo($this->getUrl('grid' , 'Admin')); ?>"> Cancel </a> </button>


