
<?php

class Model_Core_Session{

	
	public function isStarted()
	{
		if(!$this->getId())
		{
			return false;
		}
		return $this;
	}

	public function start()
	{
		if(!$this->isStarted())
		{
			session_start();
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

	public function __get($key = null)
	{
		if($this->isStarted())
		{
			if(array_key_exists($key, $_SESSION))
			{
				return $_SESSION[$key];
			}
			if($key == null)
			{
				return $_SESSION;
			}
		}
		return null;
	}
	
	public function __set($key, $value)
	{
		
		$_SESSION[$key] = $value;
		return $this;
	}

	public function __isset($key)
    {
        return isset($_SESSION[$key]);
    }
	
	public function __unset($key)
	{
		
		if(array_key_exists($key, $_SESSION))
		{
			unset($_SESSION[$key]);
		}
		return $this;
	}



}


?>