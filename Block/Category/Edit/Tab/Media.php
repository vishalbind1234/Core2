
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Category_Edit_Tab_Media extends Block_Core_Template{


	public function __construct()
	{
		$this->setTemplate('view/Category/edit/tab/media.php');
	}

	public function getCurrentCategoryMedia()
	{																									
		$categoryMedia = Ccc::getRegistry('category')->getCategoryMedia();
		return $categoryMedia;
	}




}


?>