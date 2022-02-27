
<?php Ccc::loadClass('Controller_Core_Action'); ?>
<?php

class Controller_Product_Media extends Controller_Core_Action{

	public function redirect( $url )
	{
		header("Location:" . $url );
		exit();
	}

	public function mediaAction()
	{															
		# code...
		$productMedia = Ccc::getBlock('Product_Media');         
		$productMedia->toHtml();												
	}

	public function saveAction()
	{
		# code...

		$timeStamp = date('Y-m-d_H-i-s');													
		$targetFolder = "Media/Product/" ;
		$destination = $targetFolder . $timeStamp . "_" .$_FILES['productImage']['name'] ;         

		if(!move_uploaded_file($_FILES['productImage']['tmp_name'], $destination) )
		{
			echo('-----not uploaded----');
			exit();
		}
					
		$modelProductMedia = Ccc::getModel('Product_Media');
		$modelProductMedia->productId = $this->getRequest()->getRequest('id');
		$modelProductMedia->image = $destination;
		$modelProductMedia->save();

		$url = $this->getUrl('media' , 'Product_Media');
		$this->redirect( $url );

	}

	public function updateAction()
	{															
		# code...
		$productMedia = Ccc::getModel('Product_Media');

		$mediaArray = $this->getRequest()->getPost('media');   //print_r($mediaArray); exit();

		
		foreach ($mediaArray['remove'] as $key => $value) 
		{
			$productMedia = Ccc::getModel('Product_Media');
			$productMedia->delete($value);

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

		foreach ($mediaArray['gallary'] as $key => $value) 
		{
			$productMedia = Ccc::getModel('Product_Media');
			$productMedia->id = $value;
			$productMedia->gallary = 1;
			$productMedia->save();
		}

		$productMedia = Ccc::getModel('Product_Media');
		$productMedia->id = $mediaArray['base'] ;
		$productMedia->base = 1 ;
		$productMedia->save();

		$productMedia = Ccc::getModel('Product_Media');
		$productMedia->id = $mediaArray['thum'] ;
		$productMedia->thum = 1 ;
		$productMedia->save();

		$productMedia = Ccc::getModel('Product_Media');
		$productMedia->id = $mediaArray['small'] ;
		$productMedia->small = 1 ;
		$productMedia->save();


		//$productMedia->id = $value;

		$url = $this->getUrl('media' , 'Product_Media');
		$this->redirect( $url );
	}



}

?>