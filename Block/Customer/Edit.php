
<?php  Ccc::loadClass('Block_Core_Edit'); ?>
<?php  Ccc::loadClass('Block_Customer_Edit_Tab'); ?>

<?php

class Block_Customer_Edit extends Block_Core_Edit{


	public function __construct()
	{
		parent::__construct();
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

	/*public function getCurrentCustomer()
	{																
		$modelCustomer = Ccc::getModel('Customer');                
		$id = $this->id; 
		$customer = $modelCustomer->load($id);
		return $customer;

	}*/



}





?>