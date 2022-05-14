

<?php Ccc::loadClass("Block_Core_Edit_Tab"); ?>

<?php  

class Block_Config_Edit_Tab extends Block_Core_Edit_Tab {

	public function __construct()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  echo "3";
		$this->prepareTabs();
		$this->setCurrentTab('config');
		parent::__construct();

	}

	public function prepareTabs()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  exit();
		$this->addTab([
			'title' => 'Config',
			'block' => 'Config_Edit_Tab_Config',
			'url' => $this->getUrl('edit', 'Config', ['tab' => 'config'])
		], 'config');

	
	}

}
 


?>
