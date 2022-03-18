
<?php  Ccc::loadClass('Controller_Core_Action');   ?>

<?php  

class Controller_Category_Media extends Controller_Core_Action{

	public function mediaAction()
	{
		# code...
		$id = $this->getRequest()->getRequest('id');
		$blockCategoryMedia = Ccc::getBlock('Category_Media')->setData(['id' => $id]);
		$this->getLayout()->getContent()->setChild($blockCategoryMedia);		  
		$this->renderLayout();		  
	}

	public function saveAction()
	{
		# code...
		$targetFolder = 'Media/Category/' ;
		$timeStamp = date('Y-m-d_H-i-s');
		$destination = $targetFolder . $timeStamp . "_" . $_FILES['categoryImage']['name'] ;       

		if(!move_uploaded_file($_FILES['categoryImage']['tmp_name'] , $destination))
		{
			echo('----not upload-----');
			exit();
		}

		$modelCategoryMedia = Ccc::getModel('Category_Media');     

		$id = $this->getRequest()->getRequest('id');      
		$modelCategoryMedia->categoryId = $id;
		$modelCategoryMedia->image = $destination;
		$modelCategoryMedia->save();

		$url = $this->getUrl('media' , 'Category_Media' , ['id' => $id] );      
		$this->redirect($url);
		
		
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

		$id = $this->getRequest()->getRequest('id');								
		$url = $this->getUrl('media' , 'Category_Media' , ['id' => $id] );				 
		$this->redirect($url);

	}

}



?>