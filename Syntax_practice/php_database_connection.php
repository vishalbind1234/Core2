<style>
	
	tr , th , td , table {
		border:2px solid blue;
		border-collapse: collapse;
	}

</style>

<!-------------------------------------------------------PHP----------------------------------------------->

<?php

echo("<pre>");

try{

	$conn = new PDO("mysql:host=localhost" , "vishalbind" , "vishal");
	$conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
	echo("connection open successfull" );

}
catch(PDOException $e){

	echo("connection failed" . $e->getMessage() );
}


echo("<br>");
print_r(get_object_vars($conn));

echo("<br>");
echo("hii");

try{

$conn->exec("use php_practice_db");

//$conn->exec("alter table Product change column quantitys  quantity int ");

/*$conn->exec("alter table Product add column quantit int default 0 
                                                      after price");
*/
	                                                 
/*
$conn->exec("create table Product(id int primary key not null , 
								  name varchar(64) , 
								  price int default 0	)"); 

*/

/*
$conn->beginTransaction();

$conn->exec("insert into Product values(1 , 'bread' , 100)");
$conn->exec("insert into Product values(2 , 'milk' , 50)");
$conn->exec("insert into Product values(3 , 'curd' , 40)");

$conn->commit();
*/

//$conn->exec("insert into Product values(4 , 'butter' , 80)");

$id = 5;
$name = "butter milk";
$price = 90;

/*
$stmt = $conn->prepare("insert into Product values( :id , :name , :price ) ");
$stmt->bindValue(":id" , $id);
$stmt->bindValue(":name" , $name);
$stmt->bindValue(":price" , $price);
$stmt->execute();
*/
$stmt = $conn->query(" select id , name , price , quantity 
					   from Product
					   where id >= 1  ")->fetchAll();

echo("<br>");
//var_dump($stmt->rowCount());
 
echo("<br>");
print_r($stmt);

$arr_key = array_keys($stmt[0]);
echo("<br>");
print_r($arr_key);


echo(" <table>   " );

echo("<tr>");
for($b = 0 ; $b < sizeof($arr_key) ; $b = $b+2 ){

	echo("<th>" . $arr_key[$b] . "</th>");
}
echo("</tr>");


foreach($stmt as $row){
	echo("<tr>");
	for($i = 0 ; $i < floor(sizeof($row)/2) ; $i++ ){

		echo("<td>" . $row[$i] . "</td>");
	}
	echo("</tr>");
}

echo("</table>");

//---------------------------------------------------------------------------------------


echo("<br>");
echo("transaction successfull...." . $conn->lastInsertId());



function insert($id , $name , $price , $quantity){

	global $conn;
	$stmt = $conn->prepare("insert into Product 
									   values( :id , :name , :price  , :quantity) ");
	/*
	$stmt->bindValue(":id" , $id);
	$stmt->bindValue(":name" , $name);
	$stmt->bindValue(":price" , $price);
	$stmt->bindValue(":quantity" , $quantity);

	$stmt->execute();
	*/
	$stmt->execute(["id"=>$id , "name"=>$name , "price"=>$price , 
		                                              "quantity"=>$quantity ]);

} 

// insert(6 , "xyz" , 150 , 1);


}
catch(PDOException $e){

	echo("<br>");
	echo("Error........" . $e->getMessage() );

}


$conn = null;
echo("<br>");
echo("connection closed properly" );








?>