
<?php  Ccc::loadClass('Block_Core_Edit'); ?>
<?php  Ccc::loadClass('Block_Category_Edit_Tab'); ?>

<?php

class Block_Category_Edit extends Block_Core_Edit{

	public function __construct()
	{
		parent::__construct();
	}

	public function getTab()
	{
		if($this->tab)
		{
			return $this->tab;
		}
		$tabName = get_class($this) . "_Tab";		
		$object = new $tabName();
		$this->tab = $object;						
		return $object;
	}

	public function getTabContent()
	{
		# code...
		$obj = $this->getTab()->getSelectedTab();
		$block = Ccc::getBlock($obj['block']);
		return $block;
	}
	
	//--------------------------------------------------------------------------------------

	public function getCurrentCategory()
	{
		$modelCategory = Ccc::getModel('Category');
		$id = $this->id;
		//$id = $this->getData('id');
		$category = $modelCategory->load($id);
		return $category;
	}

	public function getCategory()
	{
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