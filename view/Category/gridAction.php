
<?php  $categories =  $this->getCategory(); /* print_r($categories);  exit();*/  ?>
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

		<BUTTON> <a href="<?php echo($this->getUrl('edit' , 'Category' , [] , true)); ?>"> Add New </a> </BUTTON> 

		<table>

				<tr>
					<th> <label> ID </label> </th>
					<th> <label> Parent ID </label> </th>
					<th> <label> Whole Path </label> </th>
					<th> <label> Name </label> </th>
					<th> <label> Status </label> </th>
					<th> <label> CreatedAt </label> </th>
					<th> <label> UpdatedAt </label> </th>
				</tr>

			<?php if(!$categories) : ?>
				<tr>
					<td colspan="6"> <label>No Data Found.</label> </td>
				</tr>
			<?php else : ?>

				<?php foreach( $categories as $key => $category ) : ?> <!-- ------------------------printing array data---------------- -->
					<tr>
						
						<?php foreach( $category->getData() as $key => $value ) : ?>

							<?php  if( $key == "wholePath" ) :  ?>

								<td> <?php echo( $this->wholePathName( $category->id ) ); ?>   </td>

							<?php  else :  ?>

								<td> <?php echo($value); ?>   </td>
							
							<?php  endif  ; ?>

						<?php endforeach ;  ?>

						<td> <a href="<?php echo( $this->getUrl('edit' , 'Category' , ['id' => $category->id] ) ); ?>"  > Edit </a> </td>
						<td> <a href="<?php echo( $this->getUrl('delete' , 'Category' , ['id' => $category->id] ) ); ?>"  > Delete </a> </td>
						<td> <a href="<?php echo( $this->getUrl('media' , 'Category_Media' , ['id' => $category->id] ) ); ?>"  > Media </a> </td>
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
	$pathAsString = $adapter->fetchAll("SELECT wholePath  from Category WHERE  id = " . $id );

	$array = explode( ' > ' ,  $pathAsString[0]['wholePath'] ) ;
	

	$pathAsString2 = implode( " , " , $array ) ;

	$idSet = " ( " . $pathAsString2 . " ) " ;

	

	
	$pathAsarray = $adapter->fetchAll( "SELECT name  from Category WHERE  id  IN  $idSet  " );

	$stringToReturn = "";
	foreach ($pathAsarray as $key => $value) {
		
		$stringToReturn = $stringToReturn . $value['name'] . " > " ;
	}

	return $stringToReturn ;
	*/

/*
	global $adapter;	

	$query = "SELECT * FROM Category";
	$names = $adapter->fetchAllOne( $query , 2 );
	$idSet = $adapter->fetchAllOne( $query , 0 );
    $paths = $adapter->fetchAllOne( $query , 3 );

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