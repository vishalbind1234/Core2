
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Core_Grid extends Block_Core_Template{

	protected $collection = [];
	protected $column = [];
	protected $action = [];
	public $pager = null;

	public function __construct()
	{
		# code...
		$this->setTemplate('view/core/grid.php');
	}

	public function setCollection($data)
	{
		# code...
		$this->collection = $data;
		return $this;
	}

	public function getCollection()
	{
		return $this->collection; 
	}

	public function addColumn(array $column, $key)
	{
		# code...
		$this->column[$key] = $column;
		return $this;
	}

	public function getColumn($key = null)
	{
		# code...
		if($key)
		{
			if(array_key_exists($key, $this->column))
			{
				return $this->column[$key];
			}
			return null;
		}
		return $this->column;
	}

	public function addAction(array $arr)
	{
		# code...
		array_push($this->action, $arr);
		return $this;
	}

	public function getAction()
	{
		# code...
		return $this->action;
	}


	public function getPager()
	{
		if(!$this->pager)
		{
			$this->setPager();
		}
		return $this->pager;
	}
	public function setPager()
	{
		$this->pager = Ccc::getModel('Core_Pager');
		return $this;
	}


}



?>