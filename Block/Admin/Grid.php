
<?php  Ccc::loadClass('Block_Core_Grid'); ?>

<?php

class Block_Admin_Grid extends Block_Core_Grid{


	public function __construct()
	{
		# code...
		parent::__construct();
		$this->prepareCollection();
		$this->prepareColumn();
		$this->prepareAction();

		//$this->setTemplate('view/Admin/gridAction.php');
	}

	
	public function getAdmin()
	{
		$currentPage = Ccc::getModel("Core_Request")->getRequest('currentPage', 1);
		$perPageCount = Ccc::getModel("Core_Request")->getRequest('perPageCount', 10);
		$ppc = Ccc::getModel("Core_Request")->getPost('perPageCount');
		if($ppc)
		{
			$perPageCount = $ppc;
		}

		$modelAdmin = Ccc::getModel('Admin');
		$dataCount = $modelAdmin->fetchOne();

		$modelPager = $this->getPager()->setPerPageCount($perPageCount)->setCurrent($currentPage);   
		$modelPager = $modelPager->execute($dataCount, $currentPage);  

		$start = $modelPager->getStartLimit() - 1;     
		$offset = $modelPager->getPerPageCount();	

		$result = $modelAdmin->fetchAll("SELECT * FROM Admin LIMIT {$start} , {$offset}");
		return $result;
	}

	public function prepareCollection()
	{
		# code...
		$result = $this->getAdmin();
		$this->setCollection($result);
		return $this;
	}

	public function prepareColumn()
	{
		# code...
		$this->addColumn([
			'title' => 'Admin_Id',
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
			'title' => 'Password',
			'type' => 'password'
		], 'password');

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

		return $this;
	}

	public function getAddNewUrl()
	{
		# code...
		return $this->getUrl('edit','Admin', null , true);
	}

	public function getEditUrl($id)
	{
		# code...
		return $this->getUrl('edit','Admin',['id' => $id]);
	}

	public function getDeleteUrl($id)
	{
		# code...
		return $this->getUrl('delete','Admin',['id' => $id]);
	}

	public function getColumnValue($key,$value)
	{
		# code...
		if($key == 'status')
		{
			return Ccc::getModel('Admin')->getStatus($value);
		}
		return $value;
	}







}



?>