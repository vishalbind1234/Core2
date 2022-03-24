
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php



class Block_Vendor_Grid extends Block_Core_Template{

	protected $pager = null;

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';

	public function __construct()
	{													
		# code...
		$this->setTemplate('view/Vendor/gridAction.php');					

	}


	/*public function getVendor()
	{																																
		# code...
		$modelVendor = Ccc::getModel('Vendor');											
		$vendorTable = $modelVendor->getResource()->getTableName();
		$row = $modelVendor->fetchAll(" SELECT * FROM {$vendorTable} ");
		return $row;
	
	}*/


	public function getStatus()
	{
		# code...
		$status = [ 
			self::ENABLE => self::ENABLE_LBL ,
			self::DISABLE => self::DISABLE_LBL
		];
		return $status;
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

	public function getVendor()
	{
	
		$modelVendor = Ccc::getModel('Vendor');
		$rowCount = $modelVendor->fetchOne();

		$modelPager = $this->getPager();
		$modelPager->execute($rowCount, $modelPager->getCurrent());

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelVendor->fetchAll("SELECT * FROM Vendor LIMIT {$start} , {$offset}");
		return $result;


	}



}











?>