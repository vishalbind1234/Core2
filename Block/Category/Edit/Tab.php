

<?php Ccc::loadClass("Block_Core_Edit_Tab"); ?>

<?php  

class Block_Category_Edit_Tab extends Block_Core_Edit_Tab {

	public function __construct()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  echo "3";
		$this->prepareTabs();
		$this->setCurrentTab('category');
		parent::__construct();

	}

	public function prepareTabs()
	{
		# code...
		//echo "<pre>"; print_r($_GET);  exit();
		$this->addTab([
			'title' => 'Category',
			'block' => 'Category_Edit_Tab_Category',
			'url' => $this->getUrl('edit', 'Category', ['tab' => 'category'])
		], 'category');

		$this->addTab([
			'title' => 'Media',
			'block' => 'Category_Edit_Tab_Media',
			'url' => $this->getUrl('edit', 'Category', ['tab' => 'media'])
		], 'media');

	
	}

}
 


?>
