
<?php   Ccc::loadClass('Controller_Core_Action');   ?>

<?php 

class Controller_Admin_Action extends Controller_Core_Action{

	public function __construct()
	{
		$this->authenticate();
	}

	public function authenticate()
	{
		$modelAdminLogin = Ccc::getModel('Admin_Login');
		$status = $modelAdminLogin->isLoggedIn();
		if(!$status)
		{
			$url = $this->getUrl('login' , 'Admin_Login');
			$this->redirect($url);
			exit();
		}

		//echo('yess');  exit();

		//$modelAdminLogin->setData('');
	}

}






?>