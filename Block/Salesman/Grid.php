
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php



class Block_Salesman_Grid extends Block_Core_Template{

	public function __construct()
	{													
		# code...
		$this->setTemplate('view/Salesman/gridAction.php');					

	}


	public function getSalesman()
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