
<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php



class Block_Salesman_Grid extends Block_Core_Grid{

	protected $perPageCount = null;
	protected $currentPage = null;

	public function __construct()
	{													
		# code...
		parent::__construct();
		$this->prepareCollection();
		$this->prepareColumn();
		$this->prepareAction();
		//$this->setTemplate('view/Salesman/gridAction.php');					

	}

	public function getSalesman()
	{
	
		$this->currentPage =  Ccc::getModel("Core_Request")->getRequest('currentPage', 1);
		$this->perPageCount =  Ccc::getModel("Core_Request")->getRequest('perPageCount', 10);
		$ppc = Ccc::getModel("Core_Request")->getPost('perPageCount');
		if($ppc)
		{
			$this->perPageCount = $ppc;
		}
	
		$modelSalesman = Ccc::getModel('Salesman');
		$rowCount = $modelSalesman->fetchOne();

		$modelPager = $this->getPager()->setPerPageCount($this->perPageCount)->setCurrent($this->currentPage);
		$modelPager->execute($rowCount, $this->currentPage);

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelSalesman->fetchAll("SELECT * FROM Salesman LIMIT {$start} , {$offset}");
		return $result;


	}

	public function prepareCollection()
	{
		# code...
		$result = $this->getSalesman();
		$this->setCollection($result);
		return $this;
	}

	public function prepareAction()
	{
		# code...
		$this->addAction([
			'action' => 'edit',
			'method' => 'getEditUrl'
		]);

		$this->addAction([
			'action' => 'delete',
			'method' => 'getDeleteUrl'
		]);
	}

	public function prepareColumn()
	{
		# code...
		$this->addColumn([
			'title' => 'Salesman_Id',
			'type' => 'int'
		], 'id');

		$this->addColumn([
			'title' => 'First_Name',
			'type' => 'text'
		], 'firstName');

		$this->addColumn([
			'title' => 'Last_Name',
			'type' => 'text'
		], 'lastName');

		$this->addColumn([
			'title' => 'Email',
			'type' => 'text'
		], 'email');

		$this->addColumn([
			'title' => 'Mobile',
			'type' => 'int'
		], 'mobile');

		$this->addColumn([
			'title' => 'Status',
			'type' => 'int'
		], 'status');

		$this->addColumn([
			'title' => 'CreatedAt',
			'type' => 'date'
		], 'createdAt');

		$this->addColumn([
			'title' => 'UpdatedAt',
			'type' => 'date'
		], 'updatedAt');

		$this->addColumn([
			'title' => 'Percentage',
			'type' => 'Float'
		], 'percentage');

	}


	


	public function getEditUrl($id)
	{
		# code...
		return $this->getUrl('edit', 'Salesman', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getDeleteUrl($id)
	{
		# code...
		return $this->getUrl('delete', 'Salesman', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getAddNewUrl()
	{
		# code...
		return $this->getUrl('edit', 'Salesman', null, true);
	}

	public function getColumnValue($key,$value,$row)
	{
		# code...
		if($key == 'status')
		{
			return Ccc::getModel("Salesman")->getStatus($value);
		}

		return $value;
	}



}











?>