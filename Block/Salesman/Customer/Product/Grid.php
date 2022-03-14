
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php



class Block_Salesman_Customer_Product_Grid extends Block_Core_Template{

	public function __construct()
	{													
		# code...
		$this->setTemplate('view/Salesman/Customer/Product/gridAction.php');					

	}

	public function getSalesmanCustomerProducts()
	{																																
		# code...
		$modelProduct = Ccc::getModel('Product');											
		$productTable = $modelProduct->getResource()->getTableName();
		//$salesmanId = $this->getData('id');

		$row = $modelProduct->fetchAll(" SELECT * FROM {$productTable} ");
		if(!$row)
		{
			return null;
		}
		return $row;

	}

	public function getPrice($salesmanId , $customerId , $productId)
	{
				
		$modelProduct = Ccc::getModel('Salesman_Customer_Product');	
		$query = " SELECT * FROM  Salesman_Customer_Price WHERE salesmanId = {$salesmanId} AND customerId = {$customerId} AND productId = {$productId} " ; 				
		$price = $modelProduct->fetchRow($query);
		return $price;

	}


}


?>