

<?php

require_once("Model/Core/Adapter.php");
$adapter = new Model_Core_Adapter();

$currentRecord = $adapter->fetch("select * from Categories where id =" . $_GET['id'] );
$Parent = $adapter->fetch("SELECT id , parentId , name FROM Categories");

/*$path = higherCategory( $_GET['id']  , $adapter);

function higherCategory( $self_id  , $adapter ){

	static $path = "" ;

	$higherCategory = $adapter->fetch("SELECT parentId , name  FROM Categories where id =" . $self_id ); 
	$name = $higherCategory[0]['name'] ;

	$parent_id = $higherCategory[0]['parentId'] ;

	if($parent_id == null){
		return $name ;
	}
	else{

		$path =  higherCategory($parent_id , $adapter)  . "=>" .  $name ;
	}

	return $path ;

}

echo($path);*/



function canBePlaced( $id  , $currentRecordParentId )
{
	

	$adapter2 = new Model_Core_Adapter() ;

	$query = "select * from Categories";
	/*$names = $adapter2->fetchOne( $query , 2 );*/
	$idSet = $adapter2->fetchOne( $query , 0 );

    /*$id_name_arr = array_combine($idSet, $names );*/

    $paths = $adapter2->fetchOne( $query , 3 );

    $idPathArray = array_combine($idSet, $paths );

    $pathAsArray = explode( " > " , $idPathArray[$id] ); 

    $pathAsArray[sizeof($pathAsArray) - 1] = 0;
     
    if(  in_array( $currentRecordParentId , $pathAsArray ) ){

    		return false;
    }

    return true;
 	
}


 
?>

<!DOCTYPE html>

<html>
	
	<head>
		<style type="text/css">
			table , tr , td {
				border:2px solid blue;
				border-collapse: collapse;
				width: 50%;
			}
		</style>
		

	</head>

	<body>

		<form action="index.php?a=save&c=Categories" method="post">


			<table>

				<tr>
					<td colspan="2"><label> Category &nbsp </label></td>
					
				</tr>

				<tr>
					<td><label> ID &nbsp </label></td>                                        <!-- readonly , hidden , disable -->
					<td><input type="number" name=Category[id] value=<?php echo( $currentRecord[0]['id']); ?>  readonly ></td>
				</tr>

				<tr>
					<td><label> Parent ID &nbsp </label></td>
					<td> <select name=Category[parentId]   >
							<option value="" >  No parent .  </option>
							<?php foreach($Parent as $parent) : ?>
								
 								<?php if(  canBePlaced( $parent['id']   , $currentRecord[0]['parentId']  ) ) : ?>
								
									<option value=<?php echo($parent['id']); ?>
									              <?php if( $parent['id'] == $currentRecord[0]['parentId'] ){ echo(' selected'); } ?>   >  
									              <?php echo($parent['name']); ?>   
									</option>

 								<?php endif ; ?>	

							<?php endforeach ; ?>	
						</select> 
					</td>
				</tr>

				<tr>
					<td><label> Name &nbsp </label></td>
					<td><input type="text" name=Category[name] value=<?php echo( $currentRecord[0]['name']); ?>   ></td>
				</tr>

				<tr>
					<td><label> Category Whole Path &nbsp </label></td>
					<td><input type="text" value=""  name=Category[wholePath]  value=<?php echo( $currentRecord[0]['wholePath']); ?>  ></td>
				</tr>
				
				<tr>
					<td><label> Status &nbsp </label></td>
					<td> <select name=Category[status]> 
							<!-- <option readonly > select </option> -->
							<option value="1"> Active </option>
							<option value="2"> Inctive </option>
					    </select> </td>
				</tr>
				
				<tr>
					<td><label> CreatedAt &nbsp </label></td>
					<td><input type="date" name=Category[createdAt]  value=<?php echo( $currentRecord[0]['createdAt']); ?>   ></td>
				</tr>
				<tr>
					<td><label> UpdatedAt &nbsp </label></td>
					<td><input type="date" name=Category[updatedAt]  value=<?php echo( date('Y-m-d') ); ?>  hidden ></td> 
				</tr>
				
			</table>

			<button type="submit" name="submit" value="submit"> Save </button>
			<button> <a href="index.php?a=grid&c=Categories"> Cancel </a> </button>

		</form>

		

	</body>

</html>

