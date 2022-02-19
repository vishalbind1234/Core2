
<?php  Ccc::loadClass('Controller_Core_Action');   ?>

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

	public function addAction( )
	{
		$productsAdd = Ccc::getBlock('Product_Add');     
		$productsAdd->toHtml();

	}

	public function editAction( )
	{
		$productsEdit = Ccc::getBlock('Product_Edit');     
		$productsEdit->toHtml();

	}

	public function deleteAction( ) /*------------------------------------------------delete function----------------------------------------------*/
	{
		$modelProduct = Ccc::getModel('Product');
		$id = $this->getRequest()->getRequest('id');
		$deletedRowId = $modelProduct->delete(['id' => $id]);

		$param['message'] = "Row id " .  $deletedRowId  . " deleted. "  ;
		$url = $this->getUrl('grid'  , 'Product' , $param);   
		$this->redirect($url);

	           
	}

	public function saveAction( ) /*-----------------------------------------save function------------------------------------------------------------------*/
	{
		
		if( array_key_exists( 'id' , $this->getRequest()->getPost('Product') ) ){

			if( !(int)$this->getRequest()->getPost('Product')['id'] )
			{
				$param['message'] = " Invalid id.  "  ;
				$url = $this->getUrl('grid'  , 'Product' , $param);   
				$this->redirect($url);
			}

			try{

				$modelProduct = Ccc::getModel('Product');
				$rowId = $modelProduct->update( $this->getRequest()->getPost('Product') , ['id' => $this->getRequest()->getPost('Product')['id'] ] );
				
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

				$modelProduct = Ccc::getModel('Product');
				$rowId = $modelProduct->insert( $this->getRequest()->getPost('Product') );

			}
			catch(Exception $e){

				$this->redirect("index.php?a=grid&c=Product&message=" . $e->getMessage() );
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