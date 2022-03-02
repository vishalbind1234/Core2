
<?php   $config = $this->getCurrentConfig();  /*print_r($config);      exit();*/ ?>

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

		<form action="<?php echo($this->getUrl('save' , 'Config' )); ?>" method="post">


			<table>

				<tr>
					<td colspan="2"><label> Config &nbsp </label></td>
					
				</tr>

				<tr>
					<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
					<td><input type="number" name=Config[id] readonly value=<?php echo( $config->id); ?>   ></td>
				</tr>
				<tr>
					<td><label> Name &nbsp </label></td>
					<td><input type="text" name=Config[name]  value=<?php echo( $config->name); ?>   ></td>
				</tr>
				
				<tr>
					<td><label> Code &nbsp </label></td>
					<td><input type="text" name=Config[code]  value=<?php echo( $config->code); ?>   ></td>
				</tr>

				<tr>
					<td><label> Value &nbsp </label></td>
					<td><input type="value" name=Config[value] value=<?php echo( $config->value); ?> ></td>
				</tr>


				<tr>
				<td><label for="status"> Status &nbsp</label></td>
				<td>
					<select name="Config[status]">
						<?php foreach ($config->getStatus() as $key => $value) : ?>
							<option value="<?php echo($key); ?>"  <?php if($config->status == $key){echo('selected');} ?> > <?php echo($value); ?> </option>
						<?php endforeach ; ?>
					</select>
				</td>
				</tr>
				
				<tr>
					<td><label> CreatedAt &nbsp </label></td>
					<td><input type="date" name=Config[createdAt]  value=<?php echo( $config->createdAt); ?>   ></td>
				</tr>
				

				<!-- -------------------------------------------------------------------------------------------------------------------------------- -->

				

				
			</table>

			<button type="submit" name="submit" value="submit"> Save </button>
			<button> <a href="<?php echo($this->getUrl('grid' , 'Config')); ?>"> Cancel </a> </button>

		</form>

		

	</body>

</html>