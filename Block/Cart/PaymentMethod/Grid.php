
<?php

Ccc::loadClass("Block_Core_Grid"); 

class Block_Cart_PaymentMethod_Grid extends Block_Core_Grid{

	protected $perPageCount = null;
	protected $currentPage = null;

	public function __construct()
	{
		# code...
		parent::__construct();
		$this->prepareCollection();
		$this->prepareColumn();
		$this->prepareAction();

		//$this->setTemplate("view/Cart/gridAction.php");
	}

/*-------------------------------------------------------------------------------------------------*/

	
/*---------------------------------------------------------------------------------------------------*/

	public function getShippingMethod()
	{
	
		$this->currentPage =  Ccc::getModel("Core_Request")->getRequest('currentPage', 1);
		$this->perPageCount =  Ccc::getModel("Core_Request")->getRequest('perPageCount', 10);
		$ppc = Ccc::getModel("Core_Request")->getPost('perPageCount');
		if($ppc)
		{
			$this->perPageCount = $ppc;
		}
	
		$modelPaymentMethod = Ccc::getModel('Cart_PaymentMethod');
		$rowCount = $modelPaymentMethod->fetchOne();

		$modelPager = $this->getPager()->setPerPageCount($this->perPageCount)->setCurrent($this->currentPage);
		$modelPager->execute($rowCount, $this->currentPage);

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelPaymentMethod->fetchAll("SELECT * FROM Payment_Method LIMIT {$start} , {$offset}");
		return $result;


	}

	public function prepareCollection()
	{
		# code...
		$result = $this->getShippingMethod();
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
			'title' => 'Payment_Method_Id',
			'type' => 'int'
		], 'id');

		$this->addColumn([
			'title' => 'Name',
			'type' => 'text'
		], 'name');

		$this->addColumn([
			'title' => 'Note',
			'type' => 'text'
		], 'note');

		$this->addColumn([
			'title' => 'Status',
			'type' => 'int'
		], 'status');

		$this->addColumn([
			'title' => 'CreatedAt',
			'type' => 'date'
		], 'createdAt');

	}


	


	public function getEditUrl($id)
	{
		# code...
		return $this->getUrl('edit', 'Cart_PaymentMethod', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getDeleteUrl($id)
	{
		# code...
		return $this->getUrl('delete', 'Cart_PaymentMethod', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getAddNewUrl()
	{
		# code...
		return $this->getUrl('edit', 'Cart_PaymentMethod', null, true);
	}

	public function getColumnValue($key,$value,$row)
	{
		# code...
		if($key == 'status')
		{
			return Ccc::getModel("Cart_PaymentMethod")->getStatus($value);
		}
		
		return $value;

	}





}

?>