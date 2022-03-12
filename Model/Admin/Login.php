
<?php Ccc::loadClass('Model_Core_Row'); ?>

<?php

class Model_Admin_Login extends Model_Core_Row{

	public function __construct()
	{
		# code...
		$this->setResourceName('Model_Admin_Resource');
		parent::__construct();
	}

	public function loginAction($email, $password)
	{
		# code...
		//$email = $this->getData('email');       
		//$password = $this->getData('password');	
		$adapter = $this->getAdapter(); 
		$row = $this->fetchRow(" SELECT * FROM Admin WHERE email = {$adapter->getConnect()->quote($email)} AND password = {$adapter->getConnect()->quote($password)} ");
		if(!$row)
		{
			return false;
		}
		
		return $row;
	}

	public function isLoggedIn()
	{
		# code...
		$modelAdminMessage = Ccc::getModel('Admin_Message');
		if($modelAdminMessage->getMessages('login'))
		{
			return true;
		}
		return false; 
	}
	
	public function logoutAction()
	{
		# code...
		//$modelAdminMessage = Ccc::getModel('Admin_Message');
		//unset($modelAdminMessage->getMessages['login'])

	}



}










?>