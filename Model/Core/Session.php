
<?php

class Model_Core_Session{

	protected $namespace = null;

	public function __construct()
	{
		$this->start();
		$this->setNamespace('core');
	}

	public function getNamespace()
	{
		return $this->namespace;
	}

	public function setNamespace($namespace)
	{
		$this->namespace = $namespace;
		return $this;
	}

	
	public function isStarted()
	{
		if($this->getId())
		{
			return true;
		}
		return false;
	}

	public function start()
	{
		if(!$this->isStarted())
		{
			session_start();
			$_SESSION[$this->getNamespace()] = [];
		}
		return $this;
	}

	public function destroy()
	{
		if($this->isStarted())
		{
			session_destroy();
		}
		return $this;
	}

	public function getId()
	{	
					
		return session_id();
	}

	public function regenerateId()
	{	
		if($this->isStarted())
		{
			session_regenerate_id();
		}			
		return $this;
	}

	public function __get($key)
	{
		if($this->isStarted())
		{
			if(array_key_exists($key, $_SESSION[$this->getNamespace()]))
			{
				return $_SESSION[$this->getNamespace()][$key];
			}
		}
		return null;
	}
	
	public function __set($key, $value)
	{
		
		$_SESSION[$this->getNamespace()][$key] = $value;
		return $this;
	}

	public function __isset($key)
    {
        return isset($_SESSION[$this->getNamespace()][$key]);
    }
	
	public function __unset($key)
	{
		
		if(array_key_exists($key, $_SESSION[$this->getNamespace()]))
		{
			unset($_SESSION[$this->getNamespace()][$key]);
		}
		return $this;
	}



}


?>