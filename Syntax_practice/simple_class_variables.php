<?php

echo("<br>");
echo("<pre>");

$num1 = 1;          //-------------------------simple variable----------------

echo("<br>");
echo($num1);

$num2 = $num1 ;
echo("<br>");
echo($num2);

$num2 = 2;

echo("<br>");
echo($num1);
echo("<br>");
echo($num2);

//-------------------------------------class variable------------------------

class bus{

	public $price = 50000;
}

$obj1 = new bus();

echo("<br>");
echo($obj1->price);

$obj2 = $obj1;

echo("<br>");
echo($obj1->price);
echo("<br>");
echo($obj2->price);

$obj2->price = 10000;

echo("<br>");
echo($obj1->price);
echo("<br>");
echo($obj2->price);










?>