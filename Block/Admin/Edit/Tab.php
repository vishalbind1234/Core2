

<?php Ccc::loadClass("Block_Core_Edit_Tab"); ?>

<?php  

class Block_Admin_Edit_Tab extends Block_Core_Edit_Tab {

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
			'title' => 'Personal',
			'block' => 'Admin_Edit_Tab_Personal',
			'url' => $this->getUrl('edit', 'Admin', ['tab' => 'personal'])
		], 'personal');

		$this->addTab([
			'title' => 'Aeroplane',
			'block' => 'Admin_Edit_Tab_XXXX',
			'url' => $this->getUrl('edit', 'Admin', ['tab' => 'xxxx'])
		], 'xxxx');
	
	}

}
 


?>
