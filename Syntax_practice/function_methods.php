<?php

echo("<pre>");

echo("<br>");
echo("php methods");

class car{

	public $name = "ABCD" ;
	public $model = "789" ;
	public $color = "red" ;
}


class_alias("car" , "bus");

$mini_car = new car();
$mini_bus = new bus();

echo("<br>");
print_r($mini_car->name);
echo("<br>");

$mini_bus->name = "WXYZ";
print_r($mini_bus->name);


echo("<br>");
print_r($mini_car->name);
echo("<br>");
print_r($mini_car);    //<----------------------------------------------
print_r($mini_bus);

if(class_exists("bus")){


	echo("<br>");
	echo("yes class exist");

}

trait print_name{

	public function name_print(){
		echo(" i am  anonymous");
	}
}

class ford extends car {
	use print_name;

	public $price = 90000;
	static public function calling(){
		echo("<br>");
		echo( get_called_class() );
    
    }

}

ford::calling();

$class_methods = get_class_methods("ford");

echo("<br>");
var_dump($class_methods);
print_r($class_methods);

$class_methods = get_class_vars("ford");
echo("<br>");
print_r($class_methods);

$ford_obj = new ford();
echo("<br>");
echo(get_class($ford_obj));

echo("<br>");
// print_r( get_declared_classes());

// print_r( get_declared_interfaces());

$ford_obj->name_print();

echo("<br>");
print_r(get_declared_traits());

echo("<br>");
print_r(get_object_vars($ford_obj));

echo("<br>");
print_r(get_parent_class($ford_obj));


interface Four_wheel_drive{

	
	public function properties() ;

}

class truck implements Four_wheel_drive{

	public static $vehicle = "volvo";
	public static $length = 8 ; 
	public function properties(){
		echo("<br>");
		$concat = $vehicle . " , " .  $length;
		echo( $concat );
		echo( $vehicle . " , " .  $length );
	} 	

}

$truck_obj = new truck();
$truck_obj->properties();  //<------------------------------------------

if(interface_exists("Four_wheel_drive")){

	echo("<br>");
	echo("yes it is present");
}


if(is_a($truck_obj , "truck")){

	echo("<br>");
	echo("yes it is an  object");
}
else
{
	echo("<br>");
	echo("yes it is not an  object");
}

if( method_exists($truck_obj, "properties") ){

	echo("<br>");
	echo("yes method  exist");
}

if( property_exists( "truck" , "vehicle") ){

	echo("<br>");
	echo("yes property  exist");  //<---------------------------------------
}






?> 