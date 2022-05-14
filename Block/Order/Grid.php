
<?php
/*
Ccc::loadClass("Block_Core_Template"); 

class Block_Order_Grid extends Block_Core_Template{

	public function __construct()
	{
		$this->setTemplate("view/Order/gridAction.php");
	}

	public function getOrderDetails()
	{
		$modelOrder = Ccc::getModel("Order");
		return $modelOrder->load($this->orderId);
	}


}*/

?>



<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php 

class Block_Order_Grid extends Block_Core_Grid{

	protected $perPageCount = null;
	protected $currentPage = null;

	public function __construct()
	{
		# code...
		parent::__construct();
		$this->prepareCollection();
		$this->prepareColumn();
		$this->prepareAction();

		//$this->setTemplate('view/Order/gridAction.php');
	}


	public function getOrder()
	{
	
		$this->currentPage =  Ccc::getModel("Core_Request")->getRequest('currentPage', 1);
		$this->perPageCount =  Ccc::getModel("Core_Request")->getRequest('perPageCount', 10);
		$ppc = Ccc::getModel("Core_Request")->getPost('perPageCount');
		if($ppc)
		{
			$this->perPageCount = $ppc;
		}
	
		$modelOrder = Ccc::getModel('Order');
		$rowCount = $modelOrder->fetchOne();

		$modelPager = $this->getPager()->setPerPageCount($this->perPageCount)->setCurrent($this->currentPage);
		$modelPager->execute($rowCount, $this->currentPage);

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelOrder->fetchAll("SELECT * FROM Order_Table LIMIT {$start} , {$offset}");
		return $result;


	}

	public function prepareCollection()
	{
		# code...
		$result = $this->getOrder();
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
			'title' => 'Order_Id',
			'type' => 'int'
		], 'id');

		$this->addColumn([
			'title' => 'Customer_Id',
			'type' => 'int'
		], 'customerId');

		$this->addColumn([
			'title' => 'First_NAme',
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
			'title' => 'Grand_Total',
			'type' => 'float'
		], 'grandTotal');

		$this->addColumn([
			'title' => 'Discount',
			'type' => 'float'
		], 'discount');

		$this->addColumn([
			'title' => 'Shipping_Method_Id',
			'type' => 'int'
		], 'shippingMethodId');

		$this->addColumn([
			'title' => 'Shipping_Amount',
			'type' => 'float'
		], 'shippingAmount');
		

		$this->addColumn([
			'title' => 'Payment_Method_Id',
			'type' => 'int'
		], 'paymentMethodId');

		$this->addColumn([
			'title' => 'State',
			'type' => 'text'
		], 'state');		

		$this->addColumn([
			'title' => 'Status',
			'type' => 'text'
		], 'status');

		$this->addColumn([
			'title' => 'CreatedAt',
			'type' => 'date'
		], 'createdAt');


	}


	


	public function getEditUrl($id)
	{
		# code...
		return $this->getUrl('edit', 'Order', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getDeleteUrl($id)
	{
		# code...
		return $this->getUrl('delete', 'Order', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getAddNewUrl()
	{
		# code...
		return $this->getUrl('edit', 'Order', null, true);
	}

	public function getColumnValue($key,$value,$row)
	{
		# code...
		return $value;

	}



}



?>