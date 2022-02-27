<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Category_Grid extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Category/gridAction.php');       
	}

	public function getCategory()
	{													
		# code...
		$modelCategory = Ccc::getModel('Category');												
		$categories = $modelCategory->fetchAll("SELECT * FROM Category ORDER BY wholePath ");				
		return $categories;
	}

	public function wholePathName( $id )
	{
		$adapter = $this->getAdapter();	

		$idNameArray = $adapter->fetchPairs('id' , 'name' , 'Category');
		$idWholePathArray = $adapter->fetchPairs('id' , 'wholePath' , 'Category');
		
	    $wholePathAsArray = explode( " > " , $idWholePathArray[$id] );  // note the spaces around seperator ( > ) is also a path of delimiter  //
	    $wholePathAsString = "";
	    foreach ($wholePathAsArray as $key => $value) {
	    	# code...
	     	$wholePathAsString = $wholePathAsString  . $idNameArray[$value] .  " > "  ; 
	    }
	    return $wholePathAsString;
	}




}








?>