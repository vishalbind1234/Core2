<?php

Ccc::loadClass('Block_Core_Template');

class Block_Salesman_Edit extends Block_Core_Template{

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Salesman/editAction.php');
	}

	public function getCurrentSalesman()
	{																																
		# code...
		$modelSalesman = Ccc::getModel('Salesman');											
		
		$id = $this->getData('id');
		$row = $modelSalesman->load($id);
		return $row;

	}


}


?>