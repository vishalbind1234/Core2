<style>
	table , tr , th ,td {
		border:2px solid red;
		border-collapse: collapse;
	
	}
	table{
		
		position:absolute;
		height:100%;
		width:100%;

	}
</style>

<?php

include_once("../Adapter.php");

$adapter = new Adapter();

/*$result = $adapter->insert( "insert into ProductGrid(name , price , quantity , status , createdAt , updatedAt) values( 'socket' , 100 , 1 , 1 , '2022-01-01' , '2022-01-01' )  " );

echo(" \n " . $result->rowCount() . " row inserted \n");

*/


$result = $adapter->fetch("select * from ProductGrid " );        //-----------------------------------

if($result->rowCount() == 0){
	echo(" \n " . $result->rowCount() . " rows returned \n");
	exit();
}
echo(" \n " . $result->rowCount() . " rows in a table \n");
$res = $result->fetchAll(PDO::FETCH_ASSOC);

//print_r($res);


$arr_key = array_keys($res[0]);
//print_r($arr_key);

echo("<br>");
	
echo("<button> <a href='product_add.php'> Add New </a> </button>");
		
echo(" <table>   " );
//------------------------loop for table head----------------
echo("<tr>");
for($b = 0 ; $b < sizeof($arr_key) ; $b++ ){

	echo("<th>" . $arr_key[$b] . "</th>");
}
echo("</tr>");
//--------------------------loop for table data--------------
foreach ($res as $row){
	echo("<tr>");
	foreach ($row as $key => $value){

		echo("<td>" . $value . "</td>");
	}
	echo("<td> <a href='product_edit.php?id=$row[id] '> Edit </a> </td>");
	echo("<td> <a href='product_delete.php?id=$row[id] '> Delete </a> </td>");
	echo("</tr> <br>");
}


echo("</table> \n\n");

/*print_r(get_class_methods($adapter->getConnect()  )   );
*/




?>