

<?php Ccc::loadClass("Block_Core_Edit_Tab"); ?>

<?php  

class Block_Salesman_Edit_Tab extends Block_Core_Edit_Tab {

	public function __construct()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  echo "3";
		$this->prepareTabs();
		$this->setCurrentTab('salesman');
		parent::__construct();

	}

	public function prepareTabs()
	{

		$this->addTab([
			'title' => 'Salesman',
			'block' => 'Salesman_Edit_Tab_Salesman',
			'url' => $this->getUrl('edit', 'Salesman', ['tab' => 'salesman'])
		], 'salesman');

		$this->addTab([
			'title' => 'Manage_Customers',
			'block' => 'Salesman_Edit_Tab_Customer',
			'url' => $this->getUrl('edit', 'Salesman', ['tab' => 'customer'])
		], 'customer');
	
	}

}
 


?>
