
<?php  Ccc::loadClass('Block_Admin_Edit_Tab'); ?>
<?php  Ccc::loadClass('Block_Core_Edit'); ?>

<?php

class Block_Admin_Edit extends Block_Core_Edit{

	protected $tab = null;

	public function __construct()
	{
		# code...
		//$this->setTemplate('view/Admin/editAction.php');
		parent::__construct();
		//print_r($_GET); echo "2";
	}

	public function getTab()
	{
		//echo "<pre>";	print_r($_GET);   echo "2.1";
		# code...
		if($this->tab)
		{
			return $this->tab;
		}
		$tabName = get_class($this) . "_Tab";		
		$object = new $tabName();
		$this->tab = $object;						
		return $object;
	}

	public function getTabContent()
	{
		# code...
		$obj = $this->getTab()->getSelectedTab();
		$block = Ccc::getBlock($obj['block']);
		return new $block();
	}

	/*public function getCurrentAdmin()
	{
		# code...
		$modelAdmin = Ccc::getModel('Admin');
		$id = $this->id;
		//$id = $this->getData('id');
		if(!$id)
		{
			$id = -1;
		}
		$admin = $modelAdmin->fetchRow("SELECT * FROM Admin Where id = {$id} ");
		return $admin;

	}*/






}








?>