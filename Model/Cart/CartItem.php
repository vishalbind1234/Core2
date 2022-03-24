<?php

Ccc::loadClass('Model_Core_Row');

class Model_Cart_CartItem extends Model_Core_Row {

	
	public function __construct()
	{
		$this->setResourceName('Cart_CartItem_Resource');					
	}

	public function getFinalPrice()
	{
		if(!$this->id)
		{
			return 0;
		}
		$modelCartItem = $this->fetchRow("SELECT * FROM Cart_Item WHERE id = {$this->id}");
		$price = $modelCartItem->price * $modelCartItem->quantity + $modelCartItem->taxAmount ;
		if($modelCartItem->discountMode == "percentage")
		{
			$finalPrice = $price - $price*($modelCartItem->discount/100);
			return $finalPrice;
		}
		$finalPrice = $price - $modelCartItem->discount;
		return $finalPrice;
	}



}


?>