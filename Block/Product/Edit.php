
<?php  Ccc::loadClass('Block_Core_Edit'); ?>
<?php  Ccc::loadClass('Block_Product_Edit_Tab'); ?>

<?php

class Block_Product_Edit extends Block_Core_Edit{

	public function __construct()
	{
		//$this->setTemplate('view/Product/editAction.php');
		parent::__construct();
	}

	public function getTab()
	{
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
		return $block;
	}




}


?>