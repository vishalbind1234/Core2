
<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php 

class Controller_Admin_Login extends Controller_Core_Action {

	public function loginAction()
	{
		# code...
		$blockAdminLogin = Ccc::getBlock('Admin_Login');
		$this->getLayout()->getHeader()->setChild($blockAdminLogin);
		$this->renderLayout();
	}

	public function loginPostAction()
	{
		# code...
		$credentials = $this->getRequest()->getPost('AdminLogin');
		//$credentials['password'] = md5($credentials['password']);
		$modelAdminLogin = Ccc::getModel('Admin_Login');   
		$status = $modelAdminLogin->loginAction($credentials['email'] , md5($credentials['password']));
		if(!$status)
		{
			$url = $this->getUrl('login', 'Admin_Login');
			$this->redirect($url);
		}
		else
		{
			$modelAdminMessage = Ccc::getModel('Admin_Message');
			$modelAdminMessage->setMessage($status->email , 'login');

			$url = $this->getUrl('grid', 'Admin');
			$this->redirect($url);
	    }
		

		//print_r($_SESSION); exit();
		//print_r($credentials); exit();
		//print_r($modelAdminLogin); exit();

	}
	
	public function logoutAction()
	{
		$modelAdminMessage = Ccc::getModel('Admin_Message');
		$modelAdminMessage->unsetMessages('login');
		$url = $this->getUrl('login', 'Admin_Login');
		$this->redirect($url);

	}
	
}






?>