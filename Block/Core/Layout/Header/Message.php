
<?php Ccc::loadClass('Block_Core_Template'); ?>
<?php 

class Block_Core_Layout_Header_Message extends Block_Core_Template{

	protected $message = null;

	public function __construct()
	{
		$this->setTemplate('view/core/layout/header/message.php');
	}

	public function getMessage()
	{
		//print_r($this->message);  exit();
		if(!$this->message)
		{
			$this->setMessage(Ccc::getModel('Core_Message'));
		}
		return $this->message;
	}

	public function setMessage($messageClassObj)
	{
		$this->message = $messageClassObj;
		return $this;	
	}


}







?>	 	 




	 	