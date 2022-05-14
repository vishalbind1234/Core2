
<?php Ccc::loadClass('Controller_Admin_Action'); ?>
<?php

class Controller_Product_Media extends Controller_Admin_Action{

	public function indexAction()
	{															
		# code...
		$id = $this->getRequest()->getRequest('id');
		$modelProduct = Ccc::getModel("Product")->load($id);
		Ccc::register('product', $modelProduct);

		$productBlock = Ccc::getBlock('Product_Edit_Tab_Media')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $productBlock,
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
		# code...
		$blockProductMedia = Ccc::getBlock("Product_Media");
		$this->getLayout()->getContent()->setChild($blockProductMedia);
		$this->renderLayout();

	}

	public function addProductAction()
	{
		# code...
		$blockAddProduct = Ccc::getBlock("Product_AddProduct");
		$this->getLayout()->getContent()->setChild($blockAddProduct);
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



	public function saveAction()
	{
		try 
		{

			//echo "<pre>"; print_r($GLOBALS); exit(); //---------------------------------------------------------------

			echo "<pre>";
			$timeStamp = date('Y-m-d_H-i-s');

			$modelProductMedia = Ccc::getModel('Product_Media');
			$targetFolder = $modelProductMedia->getImageUrl();
			$destination = $targetFolder . $timeStamp . "_" . $_FILES['productImage']['name'] ;   

			echo $destination;      

			if(!move_uploaded_file($_FILES['productImage']['tmp_name'], $destination) )
			{
				throw new Exception("file not updoaded.");
			}

			$modelProductMedia->productId = $this->getRequest()->getRequest('id');
			$modelProductMedia->image = $timeStamp . "_" . $_FILES['productImage']['name'] ;
			$modelProductMedia->save();

			$this->getMessage()->addMessage(" product Image updated successfully ");

			$this->redirect($this->getUrl('grid', 'Product' ));
			//$this->indexAction();
			
		} 
		catch (Exception $e) 
		{
			$msg = $e->getMessage();
			$this->getMessage()->addMessage($msg);
			$this->gridAction();
		}


	}

	public function updateAction()
	{															
		# code...
		$productMedia = Ccc::getModel('Product_Media');

		$mediaArray = $this->getRequest()->getPost('media');  // echo "<pre>"; print_r($mediaArray); exit();

		if(array_key_exists("remove", $mediaArray))
		{
			foreach($mediaArray['remove'] as $key => $value) 
			{
				$productMedia = Ccc::getModel('Product_Media');
				$productMedia->delete($value);

			}
		}

		foreach ($mediaArray['id'] as $key => $value) 
		{
			$productMedia = Ccc::getModel('Product_Media');
			$productMedia->id = $value;
			$productMedia->gallary = 2;
			$productMedia->small = 2;
			$productMedia->thum = 2;
			$productMedia->base = 2;
			$productMedia->save();
		}

		if(array_key_exists("gallary", $mediaArray))
		{
			foreach ($mediaArray['gallary'] as $key => $value) 
			{
				$productMedia = Ccc::getModel('Product_Media');
				$productMedia->id = $value;
				$productMedia->gallary = 1;
				$productMedia->save();
			}
		}

		if(array_key_exists("base", $mediaArray))
		{
			$productMedia = Ccc::getModel('Product_Media');
			$productMedia->id = $mediaArray['base'] ;
			$productMedia->base = 1 ;
			$productMedia->save();
		}

		if(array_key_exists("thum", $mediaArray))
		{
			$productMedia = Ccc::getModel('Product_Media');
			$productMedia->id = $mediaArray['thum'] ;
			$productMedia->thum = 1 ;
			$productMedia->save();
		}


		if(array_key_exists("small", $mediaArray))
		{
			$productMedia = Ccc::getModel('Product_Media');
			$productMedia->id = $mediaArray['small'] ;
			$productMedia->small = 1 ;
			$productMedia->save();
		}
		$this->getMessage()->addMessage(" productMedia updated successfully... ");
		//$this->redirect('edit' , 'Product' , ['tab' => 'media']);
		$this->editAction();
	}



}

?>