
<?php Ccc::loadClass('Model_Core_Message'); ?>

<?php

class Model_Admin_Message extends Model_Core_Message{

	public function __construct()
	{
		# code...
		parent::__construct();
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
		$this->session = Ccc::getModel('Admin_Session');
		return $this;
	}

	

}










?>