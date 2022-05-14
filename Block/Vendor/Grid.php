
<?php Ccc::loadClass('Block_Core_Grid'); ?>

<?php

class Block_Vendor_Grid extends Block_Core_Grid{

	protected $perPageCount = null;
	protected $currentPage = null;

	public function __construct()
	{													
		# code...p
		parent::__construct();
		$this->prepareCollection();
		$this->prepareColumn();
		$this->prepareAction();
		//$this->setTemplate('view/Vendor/gridAction.php');					

	}


	public function getVendor()
	{
	
		$this->currentPage =  Ccc::getModel("Core_Request")->getRequest('currentPage', 1);
		$this->perPageCount =  Ccc::getModel("Core_Request")->getRequest('perPageCount', 10);
		$ppc = Ccc::getModel("Core_Request")->getPost('perPageCount');
		if($ppc)
		{
			$this->perPageCount = $ppc;
		}
	
		$modelVendor = Ccc::getModel('Vendor');
		$rowCount = $modelVendor->fetchOne();

		$modelPager = $this->getPager()->setPerPageCount($this->perPageCount)->setCurrent($this->currentPage);
		$modelPager->execute($rowCount, $this->currentPage);

		$start = $modelPager->getStartLimit() - 1;
		$offset = $modelPager->getPerPageCount();
		$result = $modelVendor->fetchAll("SELECT * FROM Vendor LIMIT {$start} , {$offset}");
		return $result;

	}

	public function prepareCollection()
	{
		# code...
		$vendors = $this->getVendor();
		foreach ($vendors as &$vendor) 
		{
			$addressData = $vendor->getAddress()->getData();
			$vendor->setData($addressData);
		}
		$this->setCollection($vendors);
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
			'title' => 'Vendor_Id',
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
			'title' => 'Address_Id',
			'type' => 'int'
		], 'addressId');       //-------------------------------------------matching name (id) ----------------

		$this->addColumn([
			'title' => 'Vendor_Id',
			'type' => 'int'
		], 'vendorId');

		$this->addColumn([
			'title' => 'Country',
			'type' => 'text'
		], 'country');
		
		$this->addColumn([
			'title' => 'State',
			'type' => 'text'
		], 'state');

		$this->addColumn([
			'title' => 'City',
			'type' => 'text'
		], 'city');

		$this->addColumn([
			'title' => 'Pincode',
			'type' => 'int'
		], 'pincode');



	}


	


	public function getEditUrl($id)
	{
		# code...
		return $this->getUrl('edit', 'Vendor', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getDeleteUrl($id)
	{
		# code...
		return $this->getUrl('delete', 'Vendor', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getAddNewUrl()
	{
		# code...
		return $this->getUrl('edit', 'Vendor', null, true);
	}

	public function getColumnValue($key,$value)
	{
		# code...
		if($key == 'status')
		{
			return Ccc::getModel("Vendor")->getStatus($value);
		}
		return $value;

	}


}











?>