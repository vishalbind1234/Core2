
<?php  Ccc::loadClass('Controller_Core_Action');        ?>
<?php  Ccc::loadClass('Model_Product_Resource');        ?>

<?php

class Controller_Product extends Controller_Core_Action{

	public function redirect( $url )
	{
		header("Location:" . $url );
		exit();
	}

	public function gridAction( )
	{							
		$this->getMessage()->getSession()->start();

		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$productGrid = Ccc::getBlock('Product_Grid');
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');

		$this->getLayout()->getHeader()->setChild($menu);
		$this->getLayout()->getContent()->setChild($productGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);
		$this->renderLayout();					

		$this->getMessage()->unsetMessages();													
	        					 
		//$productsGrid->toHtml();

		$message = $this->getRequest()->getRequest('message') ;
		$message = (isset($message)) ? $this->getRequest()->getRequest('message') : " 123 " ;
		echo($message);

	}


	public function editAction()
	{
		$id = $this->getRequest()->getRequest('id');


		$menu = Ccc::getBlock('Core_Layout_Header_Menu');					
		$this->getLayout()->getHeader()->setChild($menu);
		$productEdit = Ccc::getBlock('Product_Edit')->setData(['id' => $id]);    
		$this->getLayout()->getContent()->setChild($productEdit);
		$this->renderLayout();	
		

	}

	public function deleteAction() /*------------------------------------------------delete function----------------------------------------------*/
	{
		$modelProduct = Ccc::getModel('Product');
		$id = $this->getRequest()->getRequest('id');
		$deletedRowId = $modelProduct->delete($id);
		
		$message = " row ID" . $deletedRowId . " deleted. " ;
		$modelMessage = $this->getMessage();
        $modelMessage->addMessage($message);
		$url = $this->getUrl('grid'  , 'Product' , $param);   
		$this->redirect($url);

	           
	}

	public function saveAction() /*-----------------------------------------save function---------------------------------------*/
	{
		$array = $this->getRequest()->getPost('Product');
		$modelProduct = Ccc::getModel('Product');

		if( array_key_exists( 'id' , $array ) && $array['id'] != null ){

			if( !(int)$array['id'] )
			{
				$message = 'error : id not valid. ';
        		$msg = $this->getMessage();
        		$msg->addMessage($message , Model_Core_Message::ERROR); 
				$url = $this->getUrl('grid'  , 'Product' );   
				$this->redirect($url);
			}

			try{
				
				foreach ($array as $key => $value) 
				{
					$modelProduct->$key = $value;
				}

				date_default_timezone_set('Asia/Kolkata');   
				$modelProduct->updatedAt = date('Y-m-d');     //-------updatedAt is set here--------- 
				$rowId = $modelProduct->save();
				
			}
			catch(Exception $e)
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl('grid'  , 'Product' );   
				$this->redirect($url);			
			}
			
		}
		else{

			try{

				foreach ($array as $key => $value) 
				{
					$modelProduct->$key = $value;
				}
				$rowId = $modelProduct->save();

			}
			catch(Exception $e){

				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$url = $this->getUrl('grid'  , 'Product' );   
				$this->redirect($url);	
			}
		
		}

		$message = "row id " . $rowId . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::SUCCESS);
		$url = $this->getUrl('grid'  , 'Product');   
		$this->redirect($url);	

	}

	public function errorAction( )
	{
		echo(' error occured.');
	}

}



?>