
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Category_Edit extends Block_Core_Template{

	public function __construct()
	{																					
		# code...							
		$this->setTemplate('view/Category/editAction.php');   
	}

	public function getCurrentCategory()
	{
		# code...
		$modelCategory = Ccc::getModel('Category');
		$id = $this->getData('id');
		if( !isset($id) )
		{
			$id = -1;
		}
		$category = $modelCategory->load($id);
		return $category;
	}

	public function getCategory()
	{
		# code...
		$modelCategory = Ccc::getModel('Category');
		$categories = $modelCategory->fetchAll("SELECT * FROM Category ORDER BY wholePath ");
		return $categories;
	}

	public function wholePathName( $id  = null)
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

	function possibleOptions( $currentWholePath = null  , $currentParentId = null )
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






}








?>