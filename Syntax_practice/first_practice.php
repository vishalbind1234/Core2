<?php 

echo("<pre>");

//echo(" <br> <hr> <br> php practice in sublime text ");

$name = "rajkot";
var_dump($name);

echo("<br>" . $name);

// false , !true , 0 , "0" , null , [] , "" , undefined 

$name2 = "0";

if($name2){
	echo(" <br> <br> hii , i am inside the condition");
}
else{
	echo(" <br> <br> i am in else part");

}

//--------------------------------------------------------------------------

$arr = [

		"name" => "vishal" , 
		"branch" => "ce" , 
		"enroll" => 7018
];

$arr2 = [

		"car" => "ford" , 
		"color" => "red" , 
		"model" => 7018
];

echo("<br>");
print_r( $arr);

echo($arr["name"] . " , " .  $arr["branch"] . " , " . $arr["enroll"]);

$var = true;
echo("<br>" . $var);

$arr3 = array_merge($arr , $arr2);
print_r($arr3);

$shift = array_shift($arr3);
print_r($arr3 );
echo("<br>");
print_r($shift);

array_unshift($arr3 , "i am student");
echo("<br>");
print_r($arr3);

$pop = array_pop($arr3);
echo("<br>");
print_r($arr3);
echo("<br>");
print_r($pop);

$slice = array_slice($arr3 , 1 , 3);
echo("<br>");
print_r($slice);

$flip = array_flip($arr3);
echo("<br>");
print_r($flip);


echo("<br>");
asort($arr3);
print_r($arr3);

echo("<br>");
ksort($arr3);
print_r($arr3);

$arr4 = [1,2,3,4,5,6 , 6];
$arr5 = [7,8,9,10];

$ans = array_unique($arr4);
echo("<br>");
print_r($ans);

$ans = in_array( "6" , $arr4 );
echo("<br>");
print_r($ans);

$ans = array_keys( $arr4 );
echo("<br>");
print_r($ans);

$ans = array_values( $arr4 );
echo("<br>");
print_r($ans);
//---------------------------------------------------------------
function func_1($val){

	return $val*2;
}

$ans = array_map(  "func_1" , $arr4);
echo("<br>");
print_r($ans);

$ans = array_reverse($arr4);
echo("<br>");
print_r($ans);

$ans = array_fill(4 , 3,"student" );
echo("<br>");
print_r($ans);

$ans = array_key_exists(4 , $arr4);
echo("<br>");
print_r($ans);

$ans = array_rand( $arr4 , 2);
echo("<br>");
print_r($ans[1]);









?>