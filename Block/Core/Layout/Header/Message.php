
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
			$this->setMessage();
		}
		return $this->message;
	}

	public function setMessage()
	{
		$otherClassObj = $this->getData('messageClassObject');
		
		if($otherClassObj)
		{
			$this->message = $this->getData('messageClassObject');
		}
		else
		{
			$this->message = Ccc::getModel('Core_Message');
		}
		return $this;	
		
	}


}







?>	 	 




	 	