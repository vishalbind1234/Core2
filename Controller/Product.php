
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
																			
	    $productsGrid = Ccc::getBlock('Product_Grid');     					 
		$productsGrid->toHtml();

		$message = $this->getRequest()->getRequest('message') ;
		$message = (isset($message)) ? $this->getRequest()->getRequest('message') : " 123 " ;
		echo($message);

	}


	public function editAction()
	{
		$productsEdit = Ccc::getBlock('Product_Edit');     
		$productsEdit->toHtml();

	}

	public function deleteAction() /*------------------------------------------------delete function----------------------------------------------*/
	{
		$modelProduct = Ccc::getModel('Product');
		$id = $this->getRequest()->getRequest('id');
		$deletedRowId = $modelProduct->delete($id);
		
		$param['message'] = "Row id " .  $deletedRowId  . " deleted. "  ;
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
				$param['message'] = " Invalid id.  "  ;
				$url = $this->getUrl('grid'  , 'Product' , $param);   
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
				$param['message'] = $e->getMessage()  ;
				$url = $this->getUrl('grid'  , 'Product' , $param);   
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

				$param['message'] = $e->getMessage() ;
				$url = $this->getUrl('grid'  , 'Product' , $param);   
				$this->redirect($url);	
			}
		
		}

		$param['message'] = "row id " . $rowId . " inserted/updated. " ;
		$url = $this->getUrl('grid'  , 'Product' , $param);   
		$this->redirect($url);	

	}

	public function errorAction( )
	{
		echo(' error occured.');
	}

}



?>