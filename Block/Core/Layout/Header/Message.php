
<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php 

class Block_Core_Layout_Header_Message extends Block_Core_Template{

	public function __construct()
	{
		$this->setTemplate('view/core/layout/header/message.php');
	}

	protected $message;

	public function getMessage()
	{
		if(!$this->message)
		{
			$this->setMessage();
		}
		return $this->message;
	}

	public function setMessage()
	{
		$this->message = Ccc::getModel('Core_Message');
		return $this;
	}


}







?>	 	 




	 	