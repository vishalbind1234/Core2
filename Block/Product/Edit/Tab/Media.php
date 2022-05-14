
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Product_Edit_Tab_Media extends Block_Core_Template{


	public function __construct()
	{
		$this->setTemplate('view/Product/edit/tab/media.php');
	}

	public function getCurrentProductMedia()
	{											


		$productMedia = Ccc::getRegistry('product')->getProductMedia();
		return $productMedia;
	}




}


?>