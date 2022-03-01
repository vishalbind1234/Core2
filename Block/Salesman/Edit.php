<?php

Ccc::loadClass('Block_Core_Template');

class Block_Salesman_Edit extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Salesman/editAction.php');
	}

	public function getCurrentSalesman()
	{																																
		# code...
		$modelSalesman = Ccc::getModel('Salesman');											
		/*$vendorTable = $modelSalesman->getResource()->getTableName();
		$vendorKey = $modelSalesman->getResource()->getPrimaryKey();

		$modelSalesmanAddress = Ccc::getModel('Salesman_Address');
		$addressTable = $modelSalesmanAddress->getResource()->getTableName();
		$addressKey = $modelSalesmanAddress->getResource()->getPrimaryKey();*/

		$id = $this->getData('id');
		if(!$id)
		{
			return false;
		}
		$row = $modelSalesman->fetchRow(" SELECT * FROM Salesman  WHERE id = {$id}");
		return $row;

	}

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';

	public function getStatus()
	{
		# code...
		$status = [ 
			self::ENABLE => self::ENABLE_LBL ,
			self::DISABLE => self::DISABLE_LBL
		];

		return $status;
	}

}


?>