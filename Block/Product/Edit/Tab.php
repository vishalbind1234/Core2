
<?php  Ccc::loadClass('Block_Core_Edit_Tab'); ?>

<?php

class Block_Product_Edit_Tab extends Block_Core_Edit_Tab{

	protected $productId;

	public function __construct()
	{
		parent::__construct();
		$this->prepareTabs();
		$this->setCurrentTab('product');
	}

	public function prepareTabs()
	{
		# code...
		$this->addTab([
			'title' => 'PRODUCT_EDIT',
			'block' => 'Product_Edit_Tab_Product',
			'url' => $this->getUrl('edit', 'Product', ['tab' => 'product'])
		], 'product');

		$this->addTab([
			'title' => 'MEDIA',
			'block' => 'Product_Edit_Tab_Media',
			'url' => $this->getUrl('edit', 'Product', ['tab' => 'media'])
		], 'media');

	
	}




}


?>