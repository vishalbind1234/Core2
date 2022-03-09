
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php



class Block_Salesman_Customer_Grid extends Block_Core_Template{

	public function __construct()
	{													
		# code...
		$this->setTemplate('view/Salesman/Customer/gridAction.php');					

	}

	public function getSalesmanCustomers()
	{																																
		# code...
		$modelCustomer = Ccc::getModel('Customer');											
		$customerTable = $modelCustomer->getResource()->getTableName();
		$salesmanId = $this->getData('id');
		$percentage = $this->getData('percentage');			

		$row = $modelCustomer->fetchAll(" SELECT * FROM {$customerTable} WHERE salesmanId = {$salesmanId} OR salesmanId = -1 ");
		if(!$row)
		{
			return null;
		}
		return $row;

	}


}


?>