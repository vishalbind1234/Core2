

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
		<BUTTON> <a href="index.php?a=add&c=Categories"> Add New </a> </BUTTON> 

		<table>

			<?php if(!$data['Categories']) : ?>
				<tr>
					<th> <label> ID </label> </th>
					<th> <label> Parent ID </label> </th>
					<th> <label> Whole Path </label> </th>
					<th> <label> Name </label> </th>
					<th> <label> Status </label> </th>
					<th> <label> CreatedAt </label> </th>
					<th> <label> UpdatedAt </label> </th>
				</tr>
				<tr>
					<td colspan="6"> <label>No Data Found.</label> </td>
				</tr>
			<?php else : ?>

				<?php $Keys = array_keys($data['Categories']['0']); ?>   <!-- ----------------getting arrayKeys----------------------- -->

				<tr>
				<?php foreach($Keys as $key) : ?>  <!-- -----------------------printing array keys --------------------------- -->

					<th> <?php echo($key); ?> </th>

				<?php endforeach ; ?>
				</tr>


				<?php foreach( $data['Categories'] as $category ) : ?> <!-- ------------------------printing array data---------------- -->
					<tr>
						<?php foreach( $category as $key => $value ) : ?>

							<?php  if( $key == "wholePath" ) :  ?>

								<td> <?php echo( wholePathName( $category['id'] ) ); ?>   </td>

							<?php  else :  ?>

								<td> <?php echo($value); ?>   </td>
							
							<?php  endif  ; ?>

						<?php endforeach ;  ?>
						<td> <a href="index.php?a=edit&c=Categories&id=<?php echo($category['id']); ?>"  > Edit </a> </td>
						<td> <a href="index.php?a=delete&c=Categories&id=<?php echo($category['id']); ?>"  > Delete </a> </td>
					</tr>
				<?php endforeach ;  ?>
			<?php endif ;  ?>


		 </table>

	</body>
</html>





<?php 

/*function wholePathName( $id )
{
	*/
/*	$wholePathName = "" ; 

	$adapter = new Model_Core_Adapter() ;
	$pathAsString = $adapter->fetch("SELECT wholePath  from Categories WHERE  id = " . $id );

	$array = explode( ' > ' ,  $pathAsString[0]['wholePath'] ) ;
	

	$pathAsString2 = implode( " , " , $array ) ;

	$idSet = " ( " . $pathAsString2 . " ) " ;

	

	
	$pathAsarray = $adapter->fetch( "SELECT name  from Categories WHERE  id  IN  $idSet  " );

	$stringToReturn = "";
	foreach ($pathAsarray as $key => $value) {
		
		$stringToReturn = $stringToReturn . $value['name'] . " > " ;
	}

	return $stringToReturn ;
	*/

/*
	global $adapter;	

	$query = "SELECT * FROM Categories";
	$names = $adapter->fetchOne( $query , 2 );
	$idSet = $adapter->fetchOne( $query , 0 );
    $paths = $adapter->fetchOne( $query , 3 );

    $idNameArray = array_combine($idSet, $names );
    $idPathArray = array_combine($idSet, $paths );

    $pathAsarray = explode( " > " , $idPathArray[$id] );  // note the spaces around seperator ( > ) is also a path of delimiter  //
    $pathAsString = "";
    foreach ($pathAsarray as $key => $value) {
    	# code...
     	$pathAsString = $pathAsString  . $idNameArray[$value] .  " > "  ; 
 
    }
    return $pathAsString;
*/


	
/*}
*/



?>