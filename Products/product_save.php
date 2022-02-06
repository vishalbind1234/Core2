<?php

include_once("../Adapter.php");

$adapter = new Adapter();
$adapter->connect();


if($_POST["p_id"]){		
	try{

		$stmt = $adapter->getConnect()->prepare( "update ProductGrid set name = :name , price =  :price ,quantity = :quantity , status = :status , createdAt = :createdAt , updatedAt = :updatedAt where id = " . $_POST["p_id"] ) ;

		$stmt->bindValue(":name"      , $_POST["p_name"]           ); 
		$stmt->bindValue(":price"     , (float)$_POST["p_price"]   );
		$stmt->bindValue(":quantity"  , (int)$_POST["p_quantity"]  );
		$stmt->bindValue(":status"    , (int)$_POST["p_status"]    );
		$stmt->bindValue(":createdAt" , $_POST["p_createdAt"]      );
		$stmt->bindValue(":updatedAt" , $_POST["p_updatedAt"]      );

		$stmt->execute();

		echo( " row updated successfully " );
		
	}
	catch(PDOException $e){

		echo("<br>");
		echo("error occured during: update \n  " . $e->getMessage() );
	}
	header("Location:product_grid.php");
	exit();

}
else{

	try{

		$stmt = $adapter->getConnect()->prepare( "insert into ProductGrid(name , price , quantity , status , createdAt ) values( :name , :price , :quantity , :status , :createdAt  ) ") ;

		$stmt->bindValue(":name"      , $_POST["p_name"]        );
		$stmt->bindValue(":price"     , $_POST["p_price"]       );
		$stmt->bindValue(":quantity"  , $_POST["p_quantity"]    );
		$stmt->bindValue(":status"    , $_POST["p_status"]      );
		$stmt->bindValue(":createdAt" , $_POST["p_createdAt"]   );
/*		$stmt->bindValue(":updatedAt" , $_POST["p_updatedAt"]   );
*/
		$stmt->execute();

		echo( " data inserted successfully " );

	}
	catch(PDOException $e){

		echo("<br>");
		echo("error occured during: insert \n  " . $e->getMessage() );
	}
	header("Location:product_grid.php");
	exit();

}



?>

