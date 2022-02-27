<?php  Ccc::loadClass('Block_Core_Template');  ?>

<?php

class Block_Product_Media extends Block_Core_Template{

	const STATUS_ENABLED = 1 ;
	const STATUS_ENABLED_LBL = 'ENABLE';
	const STATUS_DISABLED = 2 ;
	const STATUS_DISABLED_LBL = 'DISABLED';

	public function __construct()
	{
		# code... 
		$this->setTemplate('view/Product/mediaAction.php');    
	} 

	public function getCurrentProductMedia()
	{																									
		# code...
		$modelProductMedia = Ccc::getModel('Product_Media');
		$id = Ccc::getFront()->getRequest()->getRequest('id');
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