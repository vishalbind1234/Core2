
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Product_Edit_Tab_Product extends Block_Core_Template{

	protected $productId;

	public function __construct()
	{
		$this->setTemplate('view/Product/edit/tab/product.php');
	}

	public function getCurrentProduct()
	{
		$product = Ccc::getRegistry('product');
		return $product;
	}

	public function getAllCategories()
	{
		$modelCategory = Ccc::getModel('Category');
		$Categories = $modelCategory->fetchAll("SELECT * FROM Category");
		return $Categories;
	}

	public function wholePathName($id)
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




}


?>