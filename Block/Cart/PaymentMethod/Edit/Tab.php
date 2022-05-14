

<?php Ccc::loadClass("Block_Core_Edit_Tab"); ?>

<?php  

class Block_Cart_PaymentMethod_Edit_Tab extends Block_Core_Edit_Tab {

	public function __construct()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  echo "3";
		$this->prepareTabs();
		$this->setCurrentTab('paymentMethod');
		parent::__construct();

	}

	public function prepareTabs()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  exit();
		$this->addTab([
			'title' => 'Cart_PaymentMethod',
			'block' => 'Cart_PaymentMethod_Edit_Tab_PaymentMethod',
			'url' => $this->getUrl('edit', 'Cart_PaymentMethod', ['tab' => 'paymentMethod'])
		], 'paymentMethod');

	
	}

}
 


?>
