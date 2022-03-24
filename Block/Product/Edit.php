
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Product_Edit extends Block_Core_Template{

	protected $productId;

	public function __construct()
	{
		$this->setTemplate('view/Product/editAction.php');
	}

	public function getCurrentProduct()
	{
		$modelProduct = Ccc::getModel('Product');
		$productId = $this->id;
		//$productId = $this->getData('id');
		$product = $modelProduct->load($productId);
		return $product;

	}

	public function getAllCategories()
	{
		$modelCategory = Ccc::getModel('Category');
		$Categories = $modelCategory->fetchAll("SELECT * FROM Category");
		return $Categories;
	}

	public function wholePathName( $id )
	{
		$adapter = $this->getAdapter();	

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




	
	/*public function getCategoryName($id)
	{
		$modelCategory = Ccc::getModel('Category');
		$category = $modelCategory->fetchRow("SELECT name FROM Category WHERE id = {$id} ");
		return $category->name ;

	}*/



}


?>