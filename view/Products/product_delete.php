<?php


	$adapter = new Model_Core_Adapter();

	$del = $adapter->prepare("delete from Products where id = " . $_GET['id'] );
	$del->execute();

	$message = $del->rowCount() . " row deleted " ;
	redirect("index.php?a=grid&c=Products&message=" . $message );

?>	