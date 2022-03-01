
<?php   $page = $this->getCurrentPage();  /*print_r($page);      exit();*/ ?>

<!DOCTYPE html>

<html>
	
	<head>
		<style type="text/css">
			table , tr , td {
				border:2px solid blue;
				border-collapse: collapse;
			}
		</style>
		

	</head>

	<body>

		<form action="<?php echo($this->getUrl('save' , 'Page' )); ?>" method="post">


			<table>

				<tr>
					<td colspan="2"><label> Page &nbsp </label></td>
					
				</tr>

				<tr>
					<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
					<td><input type="number" name=Page[id] readonly value=<?php echo( $page->id); ?>   ></td>
				</tr>
				<tr>
					<td><label> Name &nbsp </label></td>
					<td><input type="text" name=Page[name]  value=<?php echo( $page->name); ?>   ></td>
				</tr>
				
				<tr>
					<td><label> Code &nbsp </label></td>
					<td><input type="text" name=Page[code]  value=<?php echo( $page->code); ?>   ></td>
				</tr>

				<tr>
					<td><label> Content &nbsp </label></td>
					<td><input type="value" name=Page[value] value=<?php echo( $page->value); ?> ></td>
				</tr>


				<tr>
					<td><label> Status &nbsp </label></td>
					<td>
						<select name=Page[status]> 
							<option value="1"> Active </option>
							<option value="2"> Inctive </option>
					    </select>
					</td>
				</tr>
				
				<tr>
					<td><label> CreatedAt &nbsp </label></td>
					<td><input type="date" name=Page[createdAt]  value=<?php echo( $page->createdAt); ?>   ></td>
				</tr>
				

				<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

				

				
			</table>

			<button type="submit" name="submit" value="submit"> Save </button>
			<button> <a href="<?php echo($this->getUrl('grid' , 'Page')); ?>"> Cancel </a> </button>

		</form>

		

	</body>

</html>