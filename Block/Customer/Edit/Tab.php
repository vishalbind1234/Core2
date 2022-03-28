

<?php Ccc::loadClass("Block_Core_Edit_Tab"); ?>

<?php  

class Block_Customer_Edit_Tab extends Block_Core_Edit_Tab {

	public function __construct()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  echo "3";
		$this->prepareTabs();
		$this->setCurrentTab('personal');
		parent::__construct();

	}

	public function prepareTabs()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  exit();
		$this->addTab([
			'title' => 'PERSONAL',
			'block' => 'Customer_Edit_Tab_Personal',
			'url' => $this->getUrl('edit', 'Customer', ['tab' => 'personal'])
		], 'personal');

		$this->addTab([
			'title' => 'Address',
			'block' => 'Customer_Edit_Tab_Address',
			'url' => $this->getUrl('edit', 'Customer', ['tab' => 'address'])
		], 'address');

		$this->addTab([
			'title' => 'ShippingAddress',
			'block' => 'Customer_Edit_Tab_ShippingAddress',
			'url' => $this->getUrl('edit', 'Customer', ['tab' => 'shippingAddress'])
		], 'shippingAddress');
	
	}

}
 


?>
