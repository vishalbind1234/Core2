<?php  Ccc::loadClass('Block_Core_Template');  ?>

<?php   

class Block_Category_Media extends Block_Core_Template{

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';
	

	public function __construct()
	{										
		# code...
		$this->setTemplate('view/Category/mediaAction.php');	  
	}

	public function getMedia()
	{																		
		# code...
		$modelCategoryMedia = Ccc::getModel('Category_Media');
		$tableName = $modelCategoryMedia->getResource()->getTableName();
		$id = $this->id;	  						                                                                                 
		//$id = $this->getData('id');	  						                                                                                 
		$media = $modelCategoryMedia->fetchAll("SELECT * FROM {$tableName} WHERE categoryId = {$id} ");
		return $media;
	}

	public function getStatus()
	{
		# code...
		$status = [
			self::ENABLE => self::ENABLE_LBL,
			self::DISABLE => self::DISABLE_LBL
		];

		return $status;
	}


}







?>