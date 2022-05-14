

<?php Ccc::loadClass("Block_Core_Edit_Tab"); ?>

<?php  

class Block_Cart_ShippingMethod_Edit_Tab extends Block_Core_Edit_Tab {

	public function __construct()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  echo "3";
		$this->prepareTabs();
		$this->setCurrentTab('shippingMethod');
		parent::__construct();

	}

	public function prepareTabs()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  exit();
		$this->addTab([
			'title' => 'Cart_ShippingMethod',
			'block' => 'Cart_ShippingMethod_Edit_Tab_ShippingMethod',
			'url' => $this->getUrl('edit', 'Cart_ShippingMethod', ['tab' => 'shippingMethod'])
		], 'shippingMethod');

	
	}

}
 


?>
