
<?php

class Model_Core_Message{

	protected $session = null;
	protected $messages = null;

	const SUCCESS = 'success';
	const ERROR   = 'error';
	const WARNING = 'warning';

	public function __construct()
	{
		//code...	
	}

	public function getSession()
	{
		if(!$this->session)
		{
			$this->setSession();

		}
		return $this->session;
	}

	public function setSession()
	{
		$this->session = Ccc::getModel('Core_Session');
		return $this;
	}

	public function addMessage($message, $type = self::SUCCESS)
	{
		$this->messages = (isset($this->getSession()->messages)) ? ($this->getSession()->messages) : [] ;
		$this->messages[$type] = $message;
		$this->getSession()->messages = $this->messages;
		return $this;
	}

	public function getMessages($key = null)
	{
		if($key)
		{
			if(isset($this->getSession()->messages[$key])) 
			{
				return $this->getSession()->messages[$key];
			}
			return null;
		}
		return $this->getSession()->messages;
	}

	public function unsetMessages($key = null)
	{
		if($key == null)
		{
			$this->getSession()->messages = [];
		}
		if(isset($this->getSession()->messages[$key])) 
		{
			unset($this->getSession()->messages[$key]);
		}
		return $this;
	}


}










?>