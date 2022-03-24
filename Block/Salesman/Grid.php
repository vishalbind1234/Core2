
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php



class Block_Salesman_Grid extends Block_Core_Template{

	protected $pager = null;

	public function __construct()
	{													
		# code...
		$this->setTemplate('view/Salesman/gridAction.php');					

	}


/*	public function getSalesman()
	{																																
		# code...
		$modelSalesman = Ccc::getModel('Salesman');											
		$salesmanTable = $modelSalesman->getResource()->getTableName();
		//$salesmanKey = $modelSalesman->getResource()->getPrimaryKey();

		$row = $modelSalesman->fetchAll(" SELECT * FROM {$salesmanTable}  ");
		if(!$row)
		{
			return null;
		}
		return $row;

	}*/


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

	public function getSalesman()
	{
	
		$modelSalesman = Ccc::getModel('Salesman');
		$rowCount = $modelSalesman->fetchOne();

		$modelPager = $this->getPager();
		$modelPager->execute($rowCount, $modelPager->getCurrent());

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelSalesman->fetchAll("SELECT * FROM Salesman LIMIT {$start} , {$offset}");
		return $result;


	}



}











?>