

<form action="<?php echo($this->getUrl('loginPost' , 'Admin_Login')); ?>"  method="post" >

	<table>

		<tr>
			<td><label> E-Mail &nbsp </label></td>
			<td><input type="text" name=AdminLogin[email]  value="" placeholder=" enter email id" ></td>
		</tr>

		<tr>
			<td><label> Password &nbsp </label></td>
			<td><input type="Password" name=AdminLogin[password]  value="" placeholder=" enter password " ></td>
		</tr>

		<tr>
			<td> <input type="submit" value="submit" > </td>
		</tr>

	</table>	
			
</form>