	
<?php  Ccc::loadClass('Controller_Admin_Action');   ?>

<?php  

class Controller_Category_Media extends Controller_Admin_Action{

	public function indexAction()
	{
		$id = $this->getRequest()->getRequest('id');
		$modelCategory = Ccc::getModel("Category")->load($id);
		Ccc::register('category', $modelCategory);

		$categoryMediaBlock = Ccc::getBlock('Category_Edit_Tab_Media')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $categoryMediaBlock,
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
		$blockCategoryMedia = Ccc::getBlock("Category_Media");
		$this->getLayout()->getContent()->setChild($blockCategoryMedia);
		$this->renderLayout();

	}

	public function addCategoryAction()
	{
		# code...
		$blockAddCategory = Ccc::getBlock("Category_AddCategory");
		$this->getLayout()->getContent()->setChild($blockAddCategory);
		$this->renderLayout();

	}

	public function saveAction()
	{
		# code...
		try 
		{

			$timeStamp = date('Y-m-d_H-i-s');
			$id = $this->getRequest()->getRequest('id');      
			$modelCategoryMedia = Ccc::getModel('Category_Media');     
			$modelCategoryMedia->categoryId = $id;
			$modelCategoryMedia->image = $timeStamp . "_" . $_FILES['categoryImage']['name'] ;
			$modelCategoryMedia->save();

			$targetFolder = $modelCategoryMedia->getImageUrl() ;
			$destination = $targetFolder . $timeStamp . "_" . $_FILES['categoryImage']['name'] ;       
			
			if(!move_uploaded_file($_FILES['categoryImage']['tmp_name'] , $destination))
			{
				throw new Exception("file not uploaded.");
			}
			$this->getMessage()->addMessage(" categoryMedia File uploaded successfully ");
			$this->gridAction();
			//echo "<pre>"; print_r($GLOBALS); exit();

		} 
		catch (Exception $e) 
		{
			$this->getMessage()->addMessage($e->getMessage());
			$this->gridAction();
		}
		
	}

	public function editAction()  /*----------------------------------------------editCategory()------------------------------------------*/
	{

		$id = $this->getRequest()->getRequest('id');
		$modelCategory = Ccc::getModel("Category")->load($id);
		Ccc::register('category', $modelCategory); 

		$categoryEdit = Ccc::getBlock('Category_Edit')->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $categoryEdit,
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


	public function updateAction()
	{
		# code...
		$array = $this->getRequest()->getPost('media');   

		if(array_key_exists('remove', $array))
		{
			foreach ($array['remove'] as $key => $value) 
			{
				$categoryMediaModel = Ccc::getModel('Category_Media');
				$categoryMediaModel->delete($value)  ;

			}
		}

		if(array_key_exists('id', $array))
		{
			foreach ($array['id'] as $key => $value) 
			{
				# code...
				$categoryMediaModel = Ccc::getModel('Category_Media');
				$categoryMediaModel->id = $value ;
				$categoryMediaModel->gallary = 2 ;
				$categoryMediaModel->small = 2 ;
				$categoryMediaModel->base = 2 ;
				$categoryMediaModel->thum = 2 ;
				$categoryMediaModel->status = 2 ;
				$categoryMediaModel->save();        
			}
		}
															

		if(array_key_exists('gallary', $array))
		{
			foreach ($array['gallary'] as $key => $value) 
			{
				# code...
				$categoryMediaModel = Ccc::getModel('Category_Media');
				$categoryMediaModel->id = $value ;
				$categoryMediaModel->gallary = 1 ;
				$categoryMediaModel->save();                    
			}
		}

		if(array_key_exists('status', $array))
		{
			foreach ($array['status'] as $key => $value) 
			{
				if($value){
					$categoryMediaModel = Ccc::getModel('Category_Media');
					$categoryMediaModel->id = $value ;
					$categoryMediaModel->status = 1 ;
					$categoryMediaModel->save();
				}                    
			}
		}
																				
																			

		if(array_key_exists('base', $array))
		{
			$categoryMediaModel = Ccc::getModel('Category_Media');
			$categoryMediaModel->id = $array['base'] ;
			$categoryMediaModel->base = 1 ;
			$categoryMediaModel->save();
		}																					

		if(array_key_exists('thum', $array))
		{
			$categoryMediaModel = Ccc::getModel('Category_Media');
			$categoryMediaModel->id = $array['thum'] ;
			$categoryMediaModel->thum = 1 ;
			$categoryMediaModel->save();
		}

		if(array_key_exists('small', $array))
		{	
			$categoryMediaModel = Ccc::getModel('Category_Media');
			$categoryMediaModel->id = $array['small'] ;
			$categoryMediaModel->small = 1 ;
			$categoryMediaModel->save();
		}

		$this->getMessage()->addMessage(" categoryMedia updated successfully ");
		$this->editAction();

	}

}



?>