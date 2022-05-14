<?php

Ccc::loadClass('Block_Core_Edit');
Ccc::loadClass('Block_Salesman_Edit_Tab');

class Block_Salesman_Edit extends Block_Core_Edit{

	public function __construct()
	{
		# code...
		parent::__construct();
		//$this->setTemplate('view/Salesman/editAction.php');
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