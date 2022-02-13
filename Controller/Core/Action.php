
<?php  CCC::loadClass('Model_Core_View');  ?>

<?php

class Controller_Core_Action{

	public $view = null;

	public function getView( )
	{
		if( !$this->view ){
			$this->setView( new Model_Core_View() );
		}

		return $this->view;
	}

	public function setView( $view )
	{
		$this->view = $view;
		
	}


}

?>