
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Config_Grid extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Config/gridAction.php');
	}

	public function getConfig()
	{
		# code...
		$modelConfig = Ccc::getModel('Config');
		$configs = $modelConfig->fetchAll("SELECT * FROM Config");
		if(!$configs)
		{
			return false;
		}
		return $configs;


	}

}



?>