<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Category_Grid extends Block_Core_Template{

	protected $pager = null;

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Category/gridAction.php');       
	}

/*	public function getCategory()
	{													
		# code...
		$modelCategory = Ccc::getModel('Category');												
		$categories = $modelCategory->fetchAll("SELECT * FROM Category ORDER BY wholePath ");				
		return $categories;
	}
*/
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


	public function getPager()
	{
		if(!$this->pager)
		{
			$this->setPager();
		}
		return $this->pager;
	}
	public function setPager()
	{
		$this->pager = Ccc::getModel('Core_Pager');
		return $this;
	}

	public function getCategory()
	{
	
		$modelCategory = Ccc::getModel('Category');
		$rowCount = $modelCategory->fetchOne();

		$modelPager = $this->getPager();
		$modelPager->execute($rowCount, $modelPager->getCurrent());

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelCategory->fetchAll("SELECT * FROM Category ORDER BY wholePath LIMIT {$start} , {$offset}");
		return $result;


	}






}








?>