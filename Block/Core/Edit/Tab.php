
<?php Ccc::loadClass("Block_Core_Template"); ?>

<?php  

class Block_Core_Edit_Tab extends Block_Core_Template {

	protected $tab = [];
	protected $currentTab = null;

	public function __construct()
	{
		# code...
		$this->setTemplate('view/core/edit/tab.php');
	}

	public function getSelectedTab()
	{
		# code...
		$array = Ccc::getModel("Core_Request")->getRequest();

		if(array_key_exists('tab', $array) && $array['tab'] != null)
		{
			$tabKey = $array['tab']; 
			$tab = $this->getTab($tabKey); 
			return $tab;
		}
		$tab = $this->getTab($this->getCurrentTab());
		return $tab;
	}

	public function setCurrentTab($key)
	{
		# code...
		$this->currentTab = $key;
		return $this;
	}

	public function getCurrentTab()
	{
		# code...
		return $this->currentTab;
	}

	public function getTab($key = null)
	{
		# code...
		if(!$key)
		{
			return $this->tab;
		}
		if(!array_key_exists($key, $this->tab))
		{
			return null;
		}
		return $this->tab[$key];
	}
	
	public function addTab(array $tab, $key)
	{
		# code...
		$this->tab[$key] = $tab;
		return $this;
	}

	public function setTab(array $tabs)
	{
		$this->tab = $tabs;
		return $this;
	}

	

}
 


?>
