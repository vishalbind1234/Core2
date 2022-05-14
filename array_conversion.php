
<?php
echo '<pre>';

$data = [

	['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>1,'optionname'=>'o1'],
	['category'=>1,'categoryname'=>'c1','attribute'=>1,'attributename'=>'a1','option'=>2,'optionname'=>'o2'],
	['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>3,'optionname'=>'o3'],
	['category'=>1,'categoryname'=>'c1','attribute'=>2,'attributename'=>'a2','option'=>4,'optionname'=>'o4'],
	['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>5,'optionname'=>'o5'],
	['category'=>2,'categoryname'=>'c2','attribute'=>3,'attributename'=>'a3','option'=>6,'optionname'=>'o6'],
	['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>7,'optionname'=>'o7'],
	['category'=>2,'categoryname'=>'c2','attribute'=>4,'attributename'=>'a4','option'=>8,'optionname'=>'o8']

];


$final = [] ;

foreach ($data as $row) {
	
	
	
	if( !array_key_exists( 'category' , $final) ){

		$final['category'] = [] ;
	}


	if( !array_key_exists( $row['category'], $final['category']) ){

		$final['category'][$row['category']] = [];
		
		$final['category'][$row['category']]['name'] = $row['categoryname'];
		
		$final['category'][$row['category']]['attribute'] = [] ;
	}


	if( !array_key_exists( $row['attribute'] , $final['category'][$row['category']]['attribute'] ) ){

		$final['category'][$row['category']]['attribute'][$row['attribute']] = [] ;
		
		$final['category'][$row['category']]['attribute'][$row['attribute']]['name'] = $row['attributename'] ;

		$final['category'][$row['category']]['attribute'][$row['attribute']]['option'] = [] ;
	}





	if( !array_key_exists( $row['option'] , $final['category'][$row['category']]['attribute'][$row['attribute']]['option'] ) ){

		$final['category'][$row['category']]['attribute'][$row['attribute']]['option'][$row['option']] = [] ;
		
	}

	$final['category'][$row['category']]['attribute'][$row['attribute']]['option'][$row['option']]['name'] = $row['optionname'];



}

/*print_r($final);
*/
/*------------------------------------------------------------------------------------------------------------------------------------*/




$data = [
	'category'=> [
		'1'=>[
			'name' => 'c1',
			'attribute'=>[
				'1' => [
					'name'=>'a1',
					'option' => [
						'1'=>[
							'name' => 'o1'
						],
						'2'=>[
							'name' => 'o2'
						]
					]
				],
				'2' => [
					'name'=>'a2',
					'option' => [
						'3'=>[
							'name' => 'o3'
						],
						'4'=>[
							'name' => 'o4'
						]
					]
				]
			]
		],
		'2'=>[
			'name' => 'c2',
			'attribute'=>[
				'3' => [
					'name'=>'a3',
					'option' => [
						'5'=>[
							'name' => 'o5'
						],
						'6'=>[
							'name' => 'o6'
						]
					]
				],
				'4' => [
					'name'=>'a4',
					'option' => [
						'7'=>[
							'name' => 'o7'
						],
						'8'=>[
							'name' => 'o8'
						]
					]
				]
			]
		]
	]
];


$final_array = [];

foreach ($data as $key1 => $value1) {
	# code...
	$final = [];

	foreach ($value1 as $key2 => $value2) {
		# code...
		$final['category'] = $key2;
		$final['category'] = $value2['name'];

		foreach ($value2['attribute'] as $key3 => $value3) {
			# code...
			$final['attribute'] = $key3;
			$final['attributename'] = $value3['name'];

			foreach ($value3['option'] as $key4 => $value4) {
				# code...
				$final['option'] = $key4 ;
				$final['optionname'] = $value4['name'];

				array_push($final_array , $final);

			}

		}

	}
}

/*print_r($final_array);
*/


$final_array = [];


foreach ($data as $key1 => $value1) {
	
	$final = [];
	
	foreach ($value1 as $key2 => $value2) {
		
		$final['category'] = $key2;
		$final['categoryname'] = $value2['name'];

		foreach ($value2['attribute'] as $key3 => $value3) {
			
			$final['attribute'] = $key3;
			$final['attributename'] = $value3['name'];

			foreach ($value3['option'] as $key4 => $value4) {
				# code...
				$final['option'] = $key4;
				$final['optionname'] = $value4['name'];

				array_push($final_array, $final);
					
			}
					
		}

	}
}


print_r($final_array);



/*----------------------------------------------------------------------------------------------------------------------------------------------------*/



$data = [

	['category'=>1,'attribute'=>1,'option'=>1],
	['category'=>1,'attribute'=>1,'option'=>2],
	['category'=>1,'attribute'=>2,'option'=>3],
	['category'=>1,'attribute'=>2,'option'=>4],
	['category'=>2,'attribute'=>3,'option'=>5],
	['category'=>2,'attribute'=>3,'option'=>6],
	['category'=>2,'attribute'=>4,'option'=>7],
	['category'=>2,'attribute'=>4,'option'=>8]
];


$final = [];

foreach($data as $row){

	foreach($row as $key => $value){

		if( !array_key_exists( $row['category'] , $final )  ){

			$final[$row['category']] = [];
		}

		if( !array_key_exists( $row['attribute'] , $final[$row['category']] )  ){
		
			$final[$row['category']][$row['attribute']] = [] ;
		}

		if( !array_key_exists( $row['option'] , $final[$row['category']][$row['attribute']] )  ){
		
			$final[$row['category']][$row['attribute']][$row['option']] = $row['option'] ;
		}

		
	}
}

/*print_r($final);*/



/*---------------------------------------------------------------------------------------------------------------------------------------------*/












$temp = [];

$temp[1] = '1';      /*----------------------------------???????----------------------------*/
$temp[1][1] = [ 1 , 2  , 3] ;
$temp[2][1] = [ 3 , 4 ] ;
$temp[3] = [ 5 , 6 ] ;

/*print_r($temp);
print_r($temp[1][1]);
*/





 


$data = [
	'1'=>[
		'1' => [
			'1' => 1,
			'2' => 2		
		],
		'2' => [
			'3' => 3,
			'4' => 4		
		]
	],
	'2'=>[
		'3' => [
			'5' => 5,
			'6' => 6		
		],
		'4' => [
			'7' => 7,
			'8' => 8		
		]
	],
];


$final_array = [];

foreach($data as $key1 => $value1){

	$final = [];
	$final['category'] = $key1;
	foreach($value1 as $key2 => $value2){
		
		$final['attribute'] = $key2;
		foreach($value2 as $key3 => $value3){

			$final['option'] = $key3;
			array_push($final_array, $final);


		}
	}
}

/*print_r($final_array); */

/*------------------------------------------------------------------------------------------------------------------------------------------------*/





?>