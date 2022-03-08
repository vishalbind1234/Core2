
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
		

		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$this->getLayout()->getHeader()->setChild($menu);
		$productGrid = Ccc::getBlock('Product_Grid');
		$this->getLayout()->getContent()->setChild($productGrid);
		$this->renderLayout();																		
	        					 
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
		
		$param['message'] = "Row id " .  $deletedRowId  . " deleted. "  ;
		$url = $this->getUrl('grid'  , 'Product' , $param);   
		$this->redirect($url);

	           
	}

	public function saveAction() /*-----------------------------------------save function---------------------------------------*/
	{
		$array = $this->getRequest()->getPost('Product');   //print_r($array); exit();
		$modelProduct = Ccc::getModel('Product');

		if( array_key_exists( 'id' , $array ) && $array['id'] != null ){

			if( !(int)$array['id'] )
			{
				$param['message'] = " Invalid id.  "  ;
				$url = $this->getUrl('grid'  , 'Product' , $param);   
				$this->redirect($url);
			}

			try{
				$productId = $this->getRequest()->getRequest('productId');

				foreach ($array['reference'] as $key => $value) 
				{
					$modelCategoryProduct = Ccc::getModel('Product_CategoryProduct');
					if( !in_array($value, $array['category'] ))
					{
						$modelCategoryProduct->delete($key);
						unset($array['reference'][$key]); 
					}						
				}

				foreach ($array['category'] as $key => $value) 
				{
					if( !in_array($value , $array['reference']))
					{
						$modelCategoryProduct = Ccc::getModel('Product_CategoryProduct');
						$modelCategoryProduct->productId = $productId;
						$modelCategoryProduct->categoryId = $value;
						$modelCategoryProduct->save();
					}
				}

				unset($array['category']);
				unset($array['reference']);

				foreach ($array as $key => $value) 
				{
					$modelProduct->$key = $value;
				}

				date_default_timezone_set('Asia/Kolkata');   
				$modelProduct->updatedAt = date('Y-m-d');     //----------------updatedAt is set here-------------------- 
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