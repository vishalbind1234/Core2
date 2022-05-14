
<?php Ccc::loadClass('Block_Core_Edit'); ?>
<?php Ccc::loadClass('Block_Cart_PaymentMethod_Edit_Tab'); ?>

<?php 

class Block_Cart_PaymentMethod_Edit extends Block_Core_Edit{
	
	public function __construct()
	{
		parent::__construct();
		//$this->setTemplate('view/Cart/editAction.php');
	}

	public function getCart()
	{
		# code...
		$cart = Ccc::getRegistry('cart');
		return $cart;
	}

	public function getCustomers()
	{
		$modelCustomer = Ccc::getModel("Customer");
		return $modelCustomer->fetchAll("SELECT * FROM Customer");
	}

	//-------------------------------------------------------------------------------------------

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