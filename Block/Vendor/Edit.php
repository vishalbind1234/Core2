<?php

Ccc::loadClass('Block_Core_Template');

class Block_Vendor_Edit extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Vendor/editAction.php');
	}

	public function getCurrentVendor()
	{																																
		# code...
		$modelVendor = Ccc::getModel('Vendor');											
		
		$id = $this->getData('id');
		if(!$id)
		{
			$id = -1;
		}
		$row = $modelVendor->fetchRow(" SELECT * FROM Vendor v INNER JOIN Vendor_Address a ON v.id = a.vendorId  WHERE id = {$id}");
		return $row;

	}

	/*const ENABLE = 1;
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
	}*/

}


?>