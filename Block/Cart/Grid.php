
<?php

Ccc::loadClass("Block_Core_Grid"); 

class Block_Cart_Grid extends Block_Core_Grid{

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

	public function getCart()
	{
	
		$this->currentPage =  Ccc::getModel("Core_Request")->getRequest('currentPage', 1);
		$this->perPageCount =  Ccc::getModel("Core_Request")->getRequest('perPageCount', 10);
		$ppc = Ccc::getModel("Core_Request")->getPost('perPageCount');
		if($ppc)
		{
			$this->perPageCount = $ppc;
		}
	
		$modelCart = Ccc::getModel('Cart');
		$rowCount = $modelCart->fetchOne();

		$modelPager = $this->getPager()->setPerPageCount($this->perPageCount)->setCurrent($this->currentPage);
		$modelPager->execute($rowCount, $this->currentPage);

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelCart->fetchAll("SELECT * FROM Cart LIMIT {$start} , {$offset}");
		return $result;


	}

	public function prepareCollection()
	{
		# code...
		$result = $this->getCart();
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
			'title' => 'Cart_Id',
			'type' => 'int'
		], 'id');

		$this->addColumn([
			'title' => 'CustomerID',
			'type' => 'int'
		], 'customerId');

		$this->addColumn([
			'title' => 'Shipping_Method_Id',
			'type' => 'int'
		], 'shippingMethodId');

		$this->addColumn([
			'title' => 'Shipping_Charge',
			'type' => 'float'
		], 'shippingCharge');


		$this->addColumn([
			'title' => 'Payment_Method_Id',
			'type' => 'int'
		], 'paymentMethodId');

		$this->addColumn([
			'title' => 'Cart_Total',
			'type' => 'float'
		], 'cartTotal');
		
		$this->addColumn([
			'title' => 'Discount',
			'type' => 'float'
		], 'discount');

		$this->addColumn([
			'title' => 'CreatedAt',
			'type' => 'date'
		], 'createdAt');

		$this->addColumn([
			'title' => 'UpdatedAt',
			'type' => 'date'
		], 'updatedAt');


	}


	


	public function getEditUrl($id)
	{
		# code...
		return $this->getUrl('edit', 'Cart', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getDeleteUrl($id)
	{
		# code...
		return $this->getUrl('delete', 'Cart', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getAddNewUrl()
	{
		# code...
		return $this->getUrl('edit', 'Cart', null, true);
	}

	public function getColumnValue($key,$value,$row)
	{
		# code...
		if($key == 'status')
		{
			return Ccc::getModel("Cart")->getStatus($value);
		}
		
		return $value;

	}





}

?>