
<?php  Ccc::loadClass('Controller_Admin_Action');       ?>

<?php

class Controller_Product extends Controller_Admin_Action{

	public function indexAction()
	{						
		$currentPage = $this->getRequest()->getRequest('currentPage', 1);
		$this->getMessage()->addMessage(" On Page " . $currentPage, Model_Core_Message::WARNING);	
		$this->setTitle('Product_Grid');		
		$productGrid = Ccc::getBlock('Product_Grid')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $productGrid,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#messageContent',
					'content' => $messageBlock,
					'addClass' => 'bgRed'
				]
			]
		];
		$this->renderJson($response);
	}

	public function gridAction()
	{						
		$currentPage = $this->getRequest()->getRequest('currentPage', 1);
		$this->getMessage()->addMessage(" On Page " . $currentPage, Model_Core_Message::WARNING);	

		$productGrid = Ccc::getBlock('Product_Grid');

		$this->setTitle('Product_Grid');		
		$this->getLayout()->getContent()->setChild($productGrid);
		$this->renderLayout();					

	}


	public function editAction()
	{
		$id = $this->getRequest()->getRequest('id');
		$modelProduct = Ccc::getModel("Product")->load($id);
		Ccc::register('product', $modelProduct);

		$productEdit = Ccc::getBlock('Product_Edit')->toHtml();    
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $productEdit,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#messageContent',
					'content' => $messageBlock,
					'addClass' => 'bgRed'
				]
			]
		];
		$this->renderJson($response);
		

	}

	public function deleteAction() //-----------------------------------------------delete function----------------------------------------------
	{
		$modelProduct = Ccc::getModel('Product');
		$id = $this->getRequest()->getRequest('id');
		$deletedRowId = $modelProduct->delete($id);
		
		$message = " Product row Id " . $deletedRowId . " deleted. " ;
		$modelMessage = $this->getMessage()->addMessage($message);

		$this->indexAction();

	           
	}

	public function saveAction() //-----------------------------------------save function---------------------------------------
	{
		$array = $this->getRequest()->getPost('Product');  //echo "<pre>"; print_r($array); exit();
		$product = $array['item'];
		$category = (isset($array['category'])) ? $array['category'] : [];
		$reference = (isset($array['reference'])) ? $array['reference'] : [];

		//echo "<pre>"; print_r($array); exit();

		if(array_key_exists( 'id' , $product ) && $product['id'] != null){

			try
			{
				if(!(int)$product['id'])
				{
					throw new Exception(" ID not Valid. ");
				}

				$modelProduct = Ccc::getModel('Product');
				$product['updatedAt'] = date('Y-m-d'); 
				$rowId = $modelProduct->setData($product)->save();
				
				//-----------------------------------------------------------------

				foreach ($reference as $key => $value) 
				{
					$modelCategoryProduct = Ccc::getModel('Product_CategoryProduct');
					if(!in_array($value, $category))
					{
						$modelCategoryProduct->delete($key);
						unset($reference[$key]); 
					}						
				}

				foreach ($category as $key => $value) 
				{
					if(!in_array($value , $reference))
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
				$this->indexAction();		
			}
			
		}
		else
		{
			try
			{
				$modelProduct = Ccc::getModel('Product');
				$rowId = $modelProduct->setData($product)->save();
				//-----------------------------------------------------------------------------------------
				foreach ($category as $key => $value) 
				{
					$modelCategoryProduct = Ccc::getModel('Product_CategoryProduct');
					$modelCategoryProduct->productId = $rowId;
					$modelCategoryProduct->categoryId = $value;
					$modelCategoryProduct->save();
				}

			}
			catch(Exception $e)
			{
				$message = $e->getMessage() ;
				$this->getMessage()->addMessage($message , Model_Core_Message::ERROR);
				$this->indexAction();
			}
		
		}
		
		$message = "row id " . $rowId . " Saved  " ;
		$this->getMessage()->addMessage($message , Model_Core_Message::WARNING);
		$this->indexAction();
	}

	public function errorAction()
	{
		echo(' error occured.');
	}

}



?>