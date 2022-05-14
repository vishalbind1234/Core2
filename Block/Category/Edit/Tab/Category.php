
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Category_Edit_Tab_Category extends Block_Core_Template{

	public function __construct()
	{
		$this->setTemplate('view/Category/edit/tab/category.php');
	}

	//--------------------------------------------------------------------------------------

	public function getCurrentCategory()
	{
		$rowDetails = Ccc::getRegistry('category');
		return $rowDetails;
	}

	public function getWholePathName($id  = null)
	{
		$adapter =  $this->getAdapter() ; 
		if($id == null)
		{
			return null;
		}	
		$idNameArray = $adapter->fetchPairs('id' , 'name' , 'Category');
		$idWholePathArray = $adapter->fetchPairs('id' , 'wholePath' , 'Category');
		
	    $wholePathAsArray = explode( " > " , $idWholePathArray[$id] );  // note the spaces around seperator ( > ) is also a path of delimiter  //
	    $wholePathAsString = "";
	    foreach ($wholePathAsArray as $key => $value) 
	    {
	     	$wholePathAsString = $wholePathAsString  . $idNameArray[$value] .  " > "  ; 
	    }
	    return $wholePathAsString;
	}

	function possibleOptions($currentWholePath = null , $currentParentId = null)
	{
		$adapter  = $this->getAdapter() ; 
		if($currentWholePath == null  && $currentParentId == null)
		{
			$categories = $adapter->fetchAll("SELECT * FROM Category");
			return $categories;
		}
		$wholePath = explode(" > ", $currentWholePath );
		$wholePath[sizeof($wholePath) - 1] = "" ;
		$wholePathString = implode(" > ", $wholePath );
		$wholePathString = "'".$wholePathString."%'";
		$result = $adapter->fetchAll(" SELECT * FROM Category WHERE wholePath NOT LIKE {$wholePathString} ");
		return $result;
		
	}


/*
	public function getCategory()
	{
		$modelCategory = Ccc::getModel('Category');
		$categories = $modelCategory->fetchAll("SELECT * FROM Category ORDER BY wholePath ");
		return $categories;
	}*/




}








?>