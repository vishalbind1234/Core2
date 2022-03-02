
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Config_Edit extends Block_Core_Template{

	public function __construct()
	{														
		# code...
		$this->setTemplate('view/Config/editAction.php');	
	}

	public function getCurrentConfig()
	{
		# code...
		$modelConfig = Ccc::getModel('Config');
		$id = $this->getData('id');
		if(!isset($id))
		{
			$id = -1;
		}
		$configs = $modelConfig->fetchRow("SELECT * FROM Config where id = {$id}");
		return $configs;

		
	}

}



?>