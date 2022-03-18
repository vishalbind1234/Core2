
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php



class Block_Salesman_Customer_Grid extends Block_Core_Template{

	public function __construct()
	{													
		$this->setTemplate('view/Salesman/Customer/gridAction.php');					
	}

	public function getSalesmanCustomers()
	{																																
		$salesmanId = $this->getData('id');
		$modelSalesman = Ccc::getModel('Salesman');											
		$salesman = $modelSalesman->load($salesmanId);	
        return $salesman->getCustomers();

	}


}


?>