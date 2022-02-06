<?php

	include_once("../Adapter.php");

	$adapter = new Adapter();

	$res = $adapter->delete("delete from ProductGrid where id = " . $_GET['id'] );
	echo("\n deleted rows " . $res);

	header("Location:product_grid.php");
	exit();


?>	