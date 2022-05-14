

<?php Ccc::loadClass("Block_Core_Edit_Tab"); ?>

<?php  

class Block_Page_Edit_Tab extends Block_Core_Edit_Tab {

	public function __construct()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  echo "3";
		$this->prepareTabs();
		$this->setCurrentTab('page');
		parent::__construct();

	}

	public function prepareTabs()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  exit();
		$this->addTab([
			'title' => 'Page',
			'block' => 'Page_Edit_Tab_Page',
			'url' => $this->getUrl('edit', 'Page', ['tab' => 'page'])
		], 'page');

	
	
	}

}
 


?>
