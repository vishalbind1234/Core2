
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php



class Block_Vendor_Grid extends Block_Core_Template{

	public function __construct()
	{													
		# code...
		$this->setTemplate('view/Vendor/gridAction.php');					

	}


	public function getVendor()
	{																																
		# code...
		$modelVendor = Ccc::getModel('Vendor');											
		$vendorTable = $modelVendor->getResource()->getTableName();
		print_r($vendorTable);
		//$vendorKey = $modelVendor->getResource()->getPrimaryKey();

		$modelVendorAddress = Ccc::getModel('Vendor_Address');
		$addressTable = $modelVendorAddress->getResource()->getTableName();
		//$addressKey = $modelVendorAddress->getResource()->getPrimaryKey();

		$row = $modelVendor->fetchAll(" SELECT * FROM {$vendorTable} v INNER JOIN {$addressTable} a ON v.id = a.vendorId ");
		if(!$row)
		{
			return null;
		}
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