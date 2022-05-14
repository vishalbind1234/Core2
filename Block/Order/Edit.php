
<?php Ccc::loadClass('Block_Core_Template'); ?>

<?php 

class Block_Order_Edit extends Block_Core_Template{
	
	public function __construct()
	{
		$this->setTemplate("view/Order/editAction.php");
	}

	public function getOrderDetails()
	{
		# code...
		return Ccc::getRegistry('order');
	}

	

}



?>