
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php



class Block_Salesman_Customer_Product_Grid extends Block_Core_Template{


	public function __construct()
	{													
		# code...
		$this->setTemplate('view/Salesman/Customer/Product/gridAction.php');					

	}

	public function getProducts()
	{																																
		# code...
		$modelProduct = Ccc::getModel('Product');											
		$productTable = $modelProduct->getResource()->getTableName();
		$row = $modelProduct->fetchAll(" SELECT * FROM {$productTable} ");
		return $row;

	}

	public function getCustomerPrice($productId)
	{																																
		# code...
		$id = $this->getData('customerId');
		$modelCustomer = Ccc::getModel('Customer');											
		$modelCustomer = $modelCustomer->load($id);
		return $modelCustomer->getPrice($productId);

	}



}


?>