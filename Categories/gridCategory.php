
<?php  require_once("../Adapter.php");   ?>

<?php 

$adapter = new Adapter();
$Categories = $adapter->fetch("select * from Categories");

?>
<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
			table , tr , td  , th{
				border:2px solid blue;
				border-collapse: collapse;
			}
			table{
				background:pink;
				width:90%;
				
			}

		</style>
		
	</head>
	<body>
		<BUTTON> <a href="Categories.php?a=addCategory"> Add New </a> </BUTTON> 

		<table>

			<?php if(!$Categories) : ?>
				<tr>
					<th> <label> ID </label> </th>
					<th> <label> Name </label> </th>
					<th> <label> Status </label> </th>
					<th> <label> CreatedAt </label> </th>
					<th> <label> UpdatedAt </label> </th>
				</tr>
				<tr>
					<td colspan="5"> <label>No Data Found.</label> </td>
				</tr>
			<?php else : ?>

				<?php $Keys = array_keys($Categories['0']); ?>   <!-- ----------------getting arrayKeys----------------------- -->

				<tr>
				<?php foreach($Keys as $key) : ?>  <!-- -----------------------printing array keys --------------------------- -->

					<th> <?php echo($key); ?> </th>

				<?php endforeach ; ?>
				</tr>


				<?php foreach( $Categories as $category ) : ?> <!-- ------------------------printing array data---------------- -->
					<tr>
						<?php foreach( $category as $key => $value ) : ?>
							
							<td> <?php echo($value); ?>   </td>
						
						<?php endforeach ;  ?>
						<td> <a href="Categories.php?a=editCategory&id=<?php echo($category['id']); ?>"  > Edit </a> </td>
						<td> <a href="Categories.php?a=deleteCategory&id=<?php echo($category['id']); ?>"  > Delete </a> </td>
					</tr>
				<?php endforeach ;  ?>
			<?php endif ;  ?>


		 </table>

	</body>
</html>


