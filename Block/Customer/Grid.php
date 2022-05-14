<?php  Ccc::loadClass('Block_Core_Grid'); ?>

<?php

class Block_Customer_Grid extends Block_Core_Grid{

	protected $perPageCount = null;
	protected $currentPage = null;

	public function __construct()
	{
		# code...
		parent::__construct();
		$this->prepareCollection();
		$this->prepareColumn();
		$this->prepareAction();

		//$this->setTemplate('view/Customer/gridAction.php');     
	}
	
	public function getCustomer()
	{
		$this->currentPage =  Ccc::getModel("Core_Request")->getRequest('currentPage', 1);
		$this->perPageCount =  Ccc::getModel("Core_Request")->getRequest('perPageCount', 10);
		$ppc = Ccc::getModel("Core_Request")->getPost('perPageCount');
		if($ppc)
		{
			$this->perPageCount = $ppc;
		}
	
		$modelCustomer = Ccc::getModel('Customer');
		$rowCount = $modelCustomer->fetchOne();

		$modelPager = $this->getPager()->setPerPageCount($this->perPageCount)->setCurrent($this->currentPage);
		$modelPager->execute($rowCount, $this->currentPage);

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelCustomer->fetchAll("SELECT * FROM Customer LIMIT {$start} , {$offset}");
		return $result;

	}

	public function prepareCollection()
	{
		# code...
		$customers = $this->getCustomer();
		foreach($customers as  &$customer) 
		{
			# code...
			$billData = $customer->getBillingAddress()->getData();
			$customer->setData($billData);

		}
		$this->setCollection($customers);
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
			'title' => 'Customer_Id',
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
			'title' => 'CreatedAt',
			'type' => 'date'
		], 'createdAt');

		$this->addColumn([
			'title' => 'UpdatedAt',
			'type' => 'date'
		], 'updatedAt');

		$this->addColumn([
			'title' => 'SalesmanId',
			'type' => 'int'
		], 'salesman');

		$this->addColumn([
			'title' => 'Address_Id',
			'type' => 'int'
		], 'addressId');       //-------------------------------------------matching name (id) ----------------

		$this->addColumn([
			'title' => 'Customer_Id',
			'type' => 'int'
		], 'customerId');

		$this->addColumn([
			'title' => 'Address',
			'type' => 'text'
		], 'address');

		$this->addColumn([
			'title' => 'Pincode',
			'type' => 'int'
		], 'pincode');

		$this->addColumn([
			'title' => 'City',
			'type' => 'text'
		], 'city');

		$this->addColumn([
			'title' => 'State',
			'type' => 'text'
		], 'state');

		$this->addColumn([
			'title' => 'Country',
			'type' => 'text'
		], 'country');

		$this->addColumn([
			'title' => 'Ship_&_Bill',
			'type' => 'text'
		], 'same');

		$this->addColumn([
			'title' => 'Address_Type',
			'type' => 'text'
		], 'addressType');
	}


	


	public function getEditUrl($id)
	{
		# code...
		return $this->getUrl('edit', 'Customer', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getDeleteUrl($id)
	{
		# code...
		return $this->getUrl('delete', 'Customer', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getAddNewUrl()
	{
		# code...
		return $this->getUrl('edit', 'Customer', null, true);
	}

	public function getColumnValue($key,$value,$row)
	{
		# code...
		if($key == 'status')
		{
			return Ccc::getModel("Customer")->getStatus($value);
		}
		if($key == 'same')
		{
			return $val = ($value == 1) ? "SAME" : "DIFFERENT" ;
		}
		return $value;

	}






}








?>


