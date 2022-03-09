
<?php  Ccc::loadClass('Model_Core_View'); ?>

<?php

class Block_Core_Template extends Model_Core_View{


	protected $children = [];
	
	public function getHeader()
	{											
		$child = $this->getChild('header');    
		if(!$child)
		{																							
			$child = Ccc::getBlock('Core_Layout_Header');       
			$this->setChild($child , 'header');					
		}
																											
		return $child;
	}

	public function getContent()
	{
		$child = $this->getChild('content');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Content');
			$this->setChild($child , 'content');
			
		}
		return $child;
	}
	
	public function getFooter()
	{
		$child = $this->getChild('footer');
		if(!$child)
		{
			$child = Ccc::getBlock('Core_Layout_Footer');
			$this->setChild($child , 'footer');
		}
		return $child;
	}

	public function getChild($key = null)
	{
		if($key == null)
		{
			return $this->children;
		}
		if(!array_key_exists($key, $this->children))
		{
			return false;
		}
		return $this->children[$key];
	}
	
	public function setChild($object, $key = null)
	{
		if($key == null)
		{
			$key = get_class($object);
		}
		$this->children[$key] = $object;
		return $this;
	}

	public function resetChild()
	{
		$this->children = [];
		return $this;
	}

	
}








?>