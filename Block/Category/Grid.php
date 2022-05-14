
<?php  Ccc::loadClass('Block_Core_Grid'); ?>

<?php

class Block_Category_Grid extends Block_Core_Grid{

	protected $perPageCount = null;
	protected $currentPage = null;

	public function __construct()
	{
		# code...
		parent::__construct();
		$this->prepareCollection();
		$this->prepareColumn();
		$this->prepareAction();
		//$this->setTemplate('view/Category/gridAction.php');       
	}

	public function getWholePathName( $id )
	{
		$adapter = $this->getAdapter();	

		$idNameArray = $adapter->fetchPairs('id' , 'name' , 'Category');
		$idWholePathArray = $adapter->fetchPairs('id' , 'wholePath' , 'Category');
		
	    $wholePathAsArray = explode( " > " , $idWholePathArray[$id] );  // note the spaces around seperator ( > ) is also a path of delimiter  //
	    $wholePathAsString = "";
	    foreach ($wholePathAsArray as $key => $value) {
	    	# code...
	     	$wholePathAsString = $wholePathAsString  . $idNameArray[$value] .  " > "  ; 
	    }
	    return $wholePathAsString;
	}



	public function getCategory()
	{
	
		
		$this->currentPage =  Ccc::getModel("Core_Request")->getRequest('currentPage', 1);
		$this->perPageCount =  Ccc::getModel("Core_Request")->getRequest('perPageCount', 10);
		$ppc = Ccc::getModel("Core_Request")->getPost('perPageCount');
		if($ppc)
		{
			$this->perPageCount = $ppc;
		}
	
		$modelCategory = Ccc::getModel('Category');
		$rowCount = $modelCategory->fetchOne();

		$modelPager = $this->getPager()->setPerPageCount($this->perPageCount)->setCurrent($this->currentPage);
		$modelPager->execute($rowCount, $this->currentPage);

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelCategory->fetchAll("SELECT * FROM Category ORDER BY wholePath LIMIT {$start} , {$offset}");
		return $result;


	}

	public function prepareCollection()
	{
		# code...
		$categories = $this->getCategory();
		foreach ($categories as &$category) 
		{
			# code...
			$thum = $category->getThum();
			$category->thum = $thum->image;
			$base = $category->getBase();
			$category->base = $base->image;
			$small = $category->getSmall();
			$category->small = $small->image;
		}
		$this->setCollection($categories);
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
			'title' => 'Category_Id',
			'type' => 'int'
		], 'id');

		$this->addColumn([
			'title' => 'Parent_Id',
			'type' => 'int'
		], 'parentId');


		$this->addColumn([
			'title' => 'Name',
			'type' => 'text'
		], 'name');

		$this->addColumn([
			'title' => 'WholePath',
			'type' => 'text'
		], 'wholePath');

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
			'title' => 'Thum',
			'type' => 'img'
		], 'thum'); 

		$this->addColumn([
			'title' => 'Base',
			'type' => 'img'
		], 'base'); 

		$this->addColumn([
			'title' => 'Small',
			'type' => 'img'
		], 'small');       

	}


	public function getCategoryMediaUrl($id)
	{
		# code...
		return $this->getUrl('media', 'Category_Media', ['id' => $id]);
	}

	public function getEditUrl($id)
	{
		# code...
		return $this->getUrl('edit', 'Category', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getDeleteUrl($id)
	{
		# code...
		return $this->getUrl('delete', 'Category', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getAddNewUrl()
	{
		# code...
		return $this->getUrl('edit', 'Category', null, true);
	}

	public function getColumnValue($key,$value,$row)
	{
		# code...
		if($key == 'status')
		{
			return Ccc::getModel("Category")->getStatus($value);
		}
		if(in_array($key, ['thum', 'base', 'small']))
		{
			$path = Ccc::getModel("Category_Media")->getImageUrl($value);
			return "<img src={$path} >";
		}
		if($key == 'wholePath')
		{
			return $this->getWholePathName($row->id);
		}
		return $value;
	}









}








?>