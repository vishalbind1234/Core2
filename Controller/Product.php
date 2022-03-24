
<?php  Ccc::loadClass('Controller_Admin_Action');        ?>
<?php  Ccc::loadClass('Model_Product_Resource');        ?>

<?php

class Controller_Product extends Controller_Admin_Action{

	public function redirect( $url )
	{
		header("Location:" . $url );
		exit();
	}

	public function gridAction()
	{						
		$currentPage =  ($this->getRequest()->getRequest('currentPage')) ? $this->getRequest()->getRequest('currentPage') : 1 ;
		$perPageCount =  ($this->getRequest()->getRequest('perPageCount')) ? $this->getRequest()->getRequest('perPageCount') : 10 ;
		$this->getMessage()->addMessage(" On Page " . $currentPage );	

		$menu = Ccc::getBlock('Core_Layout_Header_Menu');
		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');
		$productGrid = Ccc::getBlock('Product_Grid');
		$productGrid->getPager()->setPerPageCount($perPageCount)->setCurrent($currentPage);

		$this->setTitle('Product_Grid');		
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

	public function deleteAction() //-----------------------------------------------delete function----------------------------------------------
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

	public function saveAction() //-----------------------------------------save function---------------------------------------
	{
		$array = $this->getRequest()->getPost('Product');  //echo "<pre>"; print_r($array); exit();

		if( array_key_exists( 'id' , $array ) && $array['id'] != null ){

			try{
				if(!(int)$array['id'])
				{
					throw new Exception(" ID not Valid. ");
				}

				$category = $array['category'];
				$reference = $array['reference'];

				unset($array['category']);
				unset($array['reference']);

				$modelProduct = Ccc::getModel('Product');
				$array['updatedAt'] = date('Y-m-d'); 
				$rowId = $modelProduct->setData($array)->save();
				
				//-----------------------------------------------------------------

				foreach ($reference as $key => $value) 
				{
					$modelCategoryProduct = Ccc::getModel('Product_CategoryProduct');
					if( !in_array($value, $category ))
					{
						$modelCategoryProduct->delete($key);
						unset($array['reference'][$key]); 
					}						
				}

				foreach ($category as $key => $value) 
				{
					if( !in_array($value , $reference))
					{
						$modelCategoryProduct = Ccc::getModel('Product_CategoryProduct');
						$modelCategoryProduct->productId = $rowId;
						$modelCategoryProduct->categoryId = $value;
						$modelCategoryProduct->save();
					}
				}
				
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

			try{														//print_r($array); exit();
				$category = $array['category'];
				$reference = $array['reference'];

				unset($array['category']);
				unset($array['reference']);

				$modelProduct = Ccc::getModel('Product');
				$rowId = $modelProduct->setData($array)->save();
				//-----------------------------------------------------------------------------------------
				foreach ($category as $key => $value) 
				{
					$modelCategoryProduct = Ccc::getModel('Product_CategoryProduct');
					$modelCategoryProduct->productId = $rowId;
					$modelCategoryProduct->categoryId = $value;
					$modelCategoryProduct->save();
				
				}
				


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

	public function errorAction()
	{
		echo(' error occured.');
	}

}



?>