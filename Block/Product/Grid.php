
<?php  Ccc::loadClass('Block_Core_Grid'); ?>

<?php

class Block_Product_Grid extends Block_Core_Grid{
	
	protected $perPageCount = null;
	protected $currentPage = null;

	public function __construct()
	{
		# code...
		//$this->setTemplate('view/Product/gridAction.php');
		parent::__construct();
		$this->prepareCollection();
		$this->prepareColumn();
		$this->prepareAction();
	}

	public function getProduct()
	{

		$this->currentPage =  Ccc::getModel("Core_Request")->getRequest('currentPage', 1);
		$this->perPageCount =  Ccc::getModel("Core_Request")->getRequest('perPageCount', 10);
		$ppc = Ccc::getModel("Core_Request")->getPost('perPageCount');
		if($ppc)
		{
			$this->perPageCount = $ppc;
		}
	
		$modelProduct = Ccc::getModel('Product');
		$rowCount = $modelProduct->fetchOne();

		$modelPager = $this->getPager()->setPerPageCount($this->perPageCount)->setCurrent($this->currentPage);
		$modelPager->execute($rowCount, $this->currentPage);

		$start = $modelPager->getStartLimit() - 1 ;
		$offset = $modelPager->getPerPageCount();
		$result = $modelProduct->fetchAll("SELECT * FROM Product LIMIT {$start} , {$offset}");
		return $result;


	}

	public function prepareCollection()
	{
		# code...
		$products = $this->getProduct();
		foreach ($products as &$product) 
		{
			# code...
			$thum = $product->getThum();
			$product->thum = $thum->image;
			$base = $product->getBase();
			$product->base = $base->image;
			$small = $product->getSmall();
			$product->small = $small->image;
		}
		$this->setCollection($products);
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
			'title' => 'Product_Id',
			'type' => 'int'
		], 'id');

		$this->addColumn([
			'title' => 'Name',
			'type' => 'text'
		], 'name');

		$this->addColumn([
			'title' => 'Price',
			'type' => 'float'
		], 'price');

		$this->addColumn([
			'title' => 'Discount',
			'type' => 'float'
		], 'discount');

		$this->addColumn([
			'title' => 'Discount_Mode',
			'type' => 'text'
		], 'discountMode');

		$this->addColumn([
			'title' => 'Tax_Percentage',
			'type' => 'float'
		], 'taxPercentage');

		$this->addColumn([
			'title' => 'Quantity',
			'type' => 'int'
		], 'quantity');

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
			'title' => 'SKU',
			'type' => 'text'
		], 'sku'); 

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


	public function getProductMediaUrl($id)
	{
		# code...
		return $this->getUrl('media', 'Product_Media', ['id' => $id]);
	}

	public function getEditUrl($id)
	{
		# code...
		return $this->getUrl('edit', 'Product', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getDeleteUrl($id)
	{
		# code...
		return $this->getUrl('delete', 'Product', ['id' => $id, 'perPageCount' => $this->perPageCount, 'currentPage' => $this->currentPage]);
	}

	public function getAddNewUrl()
	{
		# code...
		return $this->getUrl('edit', 'Product', null, true);
	}

	public function getColumnValue($key,$value,$row)
	{
		# code...
		if($key == 'status')
		{
			return Ccc::getModel("Product")->getStatus($value);
		}
		if(in_array($key, ['thum', 'base', 'small']))
		{
			$path = Ccc::getModel("Product_Media")->getImageUrl($value);
			return "<img src={$path} >";
		}
		return $value;
	}






}








?>