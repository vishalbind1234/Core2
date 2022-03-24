<?php  Ccc::loadClass('Block_Core_Template');  ?>

<?php

class Block_Product_Media extends Block_Core_Template{

	const STATUS_ENABLED = 1 ;
	const STATUS_ENABLED_LBL = 'ENABLE';
	const STATUS_DISABLED = 2 ;
	const STATUS_DISABLED_LBL = 'DISABLED';

	public function __construct()
	{
		$this->setTemplate('view/Product/mediaAction.php');    
	} 

	public function getCurrentProductMedia()
	{																									
		$modelProductMedia = Ccc::getModel('Product_Media');
		$id = $this->id;
		//$id = $this->getData('id');
		$productMedia = $modelProductMedia->fetchAll(" SELECT * FROM Product_Media WHERE productId = {$id}");
		return $productMedia;
	}

	public function getStatus()
	{
		$status = [
			self::STATUS_ENABLED => self::STATUS_ENABLED_LBL , 	
			self::STATUS_DISABLED => self::STATUS_DISABLED_LBL  	
		] ;
		return $status;
	}






}








?>