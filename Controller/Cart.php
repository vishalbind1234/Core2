<?php

Ccc::loadClass("Controller_Admin_Action"); 

class Controller_Cart extends Controller_Admin_Action{

	public function indexAction()
	{
		# code...
		$cartGrid = Ccc::getBlock('Cart_Grid')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#indexContent',
					'content' => $cartGrid,
					'addClass' => 'bgRed'
				]
				
			]
		];
		$this->renderJson($response);

	}

	public function gridAction()
	{
		# code...
		/*$cartGrid = Ccc::getBlock('Cart_Edit')->toHtml();
		echo $cartGrid;
*/
		$currentPage = $this->getRequest()->getRequest('currentPage', 1);
		$this->getMessage()->addMessage(" On Page " . $currentPage, Model_Core_Message::WARNING);

		$blockMessage = Ccc::getBlock('Core_Layout_Header_Message');
		$cartGrid = Ccc::getBlock('Cart_Grid');

		$this->setTitle('Cart_Grid');
		$this->getLayout()->getContent()->setChild($cartGrid);
		$this->getLayout()->getFooter()->setChild($blockMessage);			//echo "<pre>"; print_r($this->getLayout()); exit();
		$this->renderLayout();			
	}

	public function deleteAction()
	{
		$id = $this->getRequest()->getRequest('id');
		Ccc::getModel("Cart")->delete($id);
		$this->indexAction();

	}

	public function editAction()
	{
		# code...
		try 
		{
			//echo $id = $this->getRequest()->getRequest('id'); exit();
		
			$modelCart = Ccc::getModel("Cart");
			$id = $this->getRequest()->getRequest('id');
			if($id)
			{
				$modelCart->load($id);    

			}
			$this->getMessage()->setMessage($modelCart, 'cart');
			Ccc::register('cart', $modelCart); 

			//echo "<pre>";	print_r($modelCart); exit();

			$cartEdit = Ccc::getBlock("Cart_Edit")->toHtml();
			$response = [
				'status' => 'success',
				'elements' => [
					[
						'element' => '#indexContent',
						'content' => $cartEdit,
						'addClass' => 'bgRed'
					]
					
				]
			];
			$this->renderJson($response);
		} 
		catch (Exception $e) 
		{
			$msg = $e->getMessage();
			$this->getMessage()->addMessage($msg);
			$this->indexAction();	
		}
	}


	public function createCartAction()
	{
		try 
		{
			$id = $this->getRequest()->getPost('customerId');
			$customer = Ccc::getModel('Customer')->load($id);			//echo "<pre>";  print_r($cart);  exit();
			$cart = $customer->getCart();		
										 								//echo "<pre>";  print_r($cart);  exit();
			$this->getMessage()->setMessage($cart, "cart");	

			//$url = $this->getUrl("edit", "Cart", ['id' => $cart->id]);
			//$this->redirect($url);
			$this->indexAction();
		} 
		catch (Exception $e) 
		{
			$msg = $e->getMessage();
			$this->getMessage()->addMessage($msg);
			$this->editAction();	
		}
	}

	public function saveBillingAction()
	{
		$array = $this->getRequest()->getPost();										//echo "<pre>";  print_r($array);   exit();
		$billing = $array['Cart']['Billing']['BillingAddress'];
		$shipping = $array['Cart']['Shipping']['ShippingAddress'];
		$customerInfo = $array['Cart']['CustomerInfo'];
		
		$customerId = $billing['customerId'];						// ---addressId and customerId ------- excluded-----
		unset($billing['customerId']);
		$addressId = $billing['addressId'];
		unset($billing['addressId']);

		$shippingAddressId = $shipping['addressId'];
		unset($shipping['addressId']);

		$cart = $this->getMessage()->getMessages("cart");
		
		$cartBillingAddress = Ccc::getModel("Cart")->getBillingAddress();
		if(get_class($cart->getBillingAddress()) != get_class(Ccc::getModel('Customer_Address')))
		{
			$cartBillingAddress->addressId = $addressId;
		}
		$cartBillingAddress->setData($customerInfo);
		$cartBillingAddress->setData($billing);
		$cartBillingAddress->same = (isset($billing['same'])) ? 1 : 2 ;
		$cartBillingAddress->save(); 
		$cart->setBillingAddress($cartBillingAddress)->save();


		if(array_key_exists("markAsShipping", $array['Cart']['Billing']))
		{
			$cartShippingAddress = Ccc::getModel("Cart")->getShippingAddress();
			if(get_class($cart->getShippingAddress()) != get_class(Ccc::getModel('Customer_Address'))) //--------------------------------
			{
				$cartShippingAddress->addressId = $shippingAddressId;
			}
			$cartShippingAddress->setData($customerInfo);
			$cartShippingAddress->setData($billing);
			$cartShippingAddress->same = (isset($billing['same'])) ? 1 : 2 ;
			$cartShippingAddress->addressType = 'shipping';

			$cartShippingAddress->save(); 
			//$cart->setShippingAddress($cartBillingAddress)->save();
		}

		unset($billing['addressId']);
		if(array_key_exists("saveToAddressBook", $array['Cart']['Billing']))
		{
			$customerAddress = $cart->getCustomer()->getBillingAddress();
			$customerAddress->setData($billing);
			$customerAddress->save();

			$cart->getCustomer()->getBillingAddress()->setData($billing)->save();
			if(isset($billing['same']))
			{
				$customerAddress = $cart->getCustomer()->getShippingAddress();
				$customerAddress->setData($billing);
				$customerAddress->same = 1;
				$customerAddress->addressType = 'shipping';
				$customerAddress->save();
			}
		}

		$this->editAction();


	}

	public function saveShippingAction()
	{
		$array = $this->getRequest()->getPost();										
		$shipping = $array['Cart']['Shipping']['ShippingAddress'];
		$customerInfo = $array['Cart']['CustomerInfo'];
																							//echo "<pre>";  print_r($shipping);   exit();
		$shippingAddressId = $shipping['addressId'];
		unset($shipping['addressId']);

		$customerId = $shipping['customerId'];						// ---addressId and customerId ------- excluded-----
		unset($shipping['customerId']);

		$cart = $this->getMessage()->getMessages("cart");   			 print_r($cart);
		
		$cartShippingAddress = Ccc::getModel("Cart")->getShippingAddress();
		if(get_class($cart->getShippingAddress()) == get_class(Ccc::getModel('Cart_CartAddress')))
		{
			$cartShippingAddress->addressId = $shippingAddressId;
		}
		$cartShippingAddress->setData($customerInfo);
		$cartShippingAddress->setData($shipping);
		$cartShippingAddress->same = 2;        
		$cartShippingAddress->save();                                      print_r($cartShippingAddress);  
		//$cart->setShippingAddress($cartShippingAddress)->save();

		unset($shipping['addressId']);
		if(array_key_exists("saveToAddressBook", $array['Cart']['Shipping']))
		{
			$customerAddress = $cart->getCustomer()->getShippingAddress();
			$customerAddress->setData($shipping);
			$customerAddress->save();
		}	

		$this->editAction();

	}

	public function savePaymentMethodAction()
	{
		# code...
		$array = $this->getRequest()->getPost();
		$cart = $this->getMessage()->getMessages("cart");
		$methodId = $array['Cart']['paymentMethod']['method'];
		$cart->paymentMethodId = $methodId;
		$cart->setPaymentMethod(Ccc::getModel("Cart_PaymentMethod")->load($methodId))->save();

		Ccc::register('cart', $cart);
		$payment = Ccc::getBlock("Cart_PaymentMethod")->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#payment',
					'content' => $payment,
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

	public function saveShippingMethodAction()
	{
		# code...
		$array = $this->getRequest()->getPost();                          //print_r($array);  exit();
		$cart = $this->getMessage()->getMessages("cart");
		$method = $array['Cart']['shippingMethod']['method'];
		$arr = explode("/", $method);           						  //print_r($arr);  exit();
		
		$cart->shippingMethodId = $arr['0'];
		$cart->shippingCharge = $arr['1'];
		$cart->setShippingMethod(Ccc::getModel("Cart_ShippingMethod")->load($arr['0']));
		$cart->save();

		Ccc::register('cart', $cart);
		$shipping = Ccc::getBlock("Cart_ShippingMethod")->toHtml();
		$messageBlock = Ccc::getBlock('Core_Layout_Header_Message')->toHtml();
		$cartSummary = Ccc::getBlock("Cart_CartSummary")->toHtml();
		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#shipping',
					'content' => $shipping,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#messageContent',
					'content' => $messageBlock,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#cart-summary',
					'content' => $cartSummary,
					'addClass' => 'bgRed'
				]
			]
		];
		$this->renderJson($response);
	}

	public function addProductAction()
	{
		# code...
		$cart = $this->getMessage()->getMessages("cart");			
		$array = $this->getRequest()->getPost();
		$products = $array['Cart']['ProductGrid']['ProductId']; 
		$newCartItemArray = []; 									 // echo "<pre>";  print_r($products); // exit();
		foreach($products as $key => $value) 
		{
			$product = [];
			$modelProduct = Ccc::getModel("Product")->load($value);
			$product['cartId'] = $cart->id;
			$product['productId'] = $modelProduct->id;
			$product['productName'] = $modelProduct->name;
			$product['quantity'] = 1;
			$product['price'] = $modelProduct->getFinalPrice();
			$product['taxPercentage'] = $modelProduct->taxPercentage;
			$product['taxAmount'] = $modelProduct->price * ($modelProduct->taxPercentage/100) ;

			$modelCartItem = Ccc::getModel("Cart_CartItem");
			$id = $modelCartItem->setData($product)->save(); 
			array_push($newCartItemArray, $modelCartItem->load($id));

			$cart->cartTotal = $cart->cartTotal + ($modelCartItem->price * $modelCartItem->quantity  + $modelCartItem->taxAmount);   
			$cart->save();
		}
		$newCartItemArray = array_merge($cart->getCartItem() , $newCartItemArray);
		$cart->setCartItem($newCartItemArray);
		$cart->save();    						 //echo "<pre>";  print_r($modelCartItem);  exit();    

		Ccc::register('cart', $cart);
		$productList = Ccc::getBlock("Cart_ProductList")->toHtml();
		$cartItemList = Ccc::getBlock("Cart_CartItemList")->toHtml();
		$cartSummary = Ccc::getBlock("Cart_CartSummary")->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#product-list',
					'content' => $productList,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#cart-item-list',
					'content' => $cartItemList,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#cart-summary',
					'content' => $cartSummary,
					'addClass' => 'bgRed'
				]
			]
		];
		$this->renderJson($response);

		
	}

	
	public function saveProductItemAction()		
	{
		# code...
		$array = $this->getRequest()->getPost(); 					  //echo "<pre>";  print_r($array);  exit();
		$quantity = $array['Cart']['ItemQuantity']; 					 // echo "<pre>";  print_r($quantity);  exit();
		$cart = $this->getMessage()->getMessages("cart");

		$cart->cartTotal = 0;								//echo "<pre>";  print_r($modelCart);  exit();	
		$cart->discount = 0;								//echo "<pre>";  print_r($modelCart);  exit();	
		$cart->save();
		$arr = [];									 					//echo "<pre>";  print_r($modelCart);  exit();
		foreach ($quantity as $key => $value) 
		{
			$modelCartItem = Ccc::getModel("Cart_CartItem")->load($key);
			$modelCartItem->quantity = $value;
			$modelCartItem->taxAmount = ($modelCartItem->price*($modelCartItem->taxPercentage/100)) * $modelCartItem->quantity;
			$modelCartItem->discount = $array['Cart']['discountAmount'][$key];
			$modelCartItem->discountMode = $array['Cart']['discountMode'][$key];
			$modelCartItem->save();
			array_push($arr, $modelCartItem);

			$cart->cartTotal = $cart->cartTotal + $modelCartItem->getFinalPrice();
			$cart->discount = $cart->discount + $modelCartItem->getDiscountAmount();
			$cart->save();
		}
		$cart->setCartItem($arr)->save();
		
		Ccc::register('cart', $cart);
		$cartItemList = Ccc::getBlock("Cart_CartItemList")->toHtml();
		$cartSummary = Ccc::getBlock("Cart_CartSummary")->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#cart-item-list',
					'content' => $cartItemList,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#cart-summary',
					'content' => $cartSummary,
					'addClass' => 'bgRed'
				]
			]
		];
		$this->renderJson($response);
	}


	public function deleteItemAction()
	{
		# code...
		$id = $this->getRequest()->getRequest("itemId"); 
		$modelCartItem = Ccc::getModel("Cart_CartItem")->load($id);
		$cart = $this->getMessage()->getMessages("cart");     				//echo "<pre>";  print_r($cart);   exit();
		$cart->cartTotal = $cart->cartTotal - $modelCartItem->getFinalPrice();
		$cart->discount = $cart->discount - $modelCartItem->getDiscountAmount();
		$cart->setCartItem([]);
		$cart->save();

		$modelCartItem->delete($id);


		Ccc::register('cart', $cart);
		$productList = Ccc::getBlock("Cart_ProductList")->toHtml();
		$cartItemList = Ccc::getBlock("Cart_CartItemList")->toHtml();
		$cartSummary = Ccc::getBlock("Cart_CartSummary")->toHtml();

		$response = [
			'status' => 'success',
			'elements' => [
				[
					'element' => '#product-list',
					'content' => $productList,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#cart-item-list',
					'content' => $cartItemList,
					'addClass' => 'bgRed'
				],
				[
					'element' => '#cart-summary',
					'content' => $cartSummary,
					'addClass' => 'bgRed'
				]
			]
		];
		$this->renderJson($response);
	}


	public function placeOrderAction()
	{
		$cart = $this->getMessage()->getMessages("cart");
		$array = $this->getRequest()->getPost(); 

		$customerInfo = $array['Cart']['CustomerInfo'];
		$billingData  = $array['Cart']['Billing']['BillingAddress'];
		$shippingInfo = $array['Cart']['Shipping']['ShippingAddress'];
		$cartSummary  = $array['Cart']['cartSummary'];
		$paymentData  = $array['Cart']['paymentMethod'];
		$shippingData = explode("/", $array['Cart']['shippingMethod']['method']);

		$modelOrder = Ccc::getModel("Order");
		
		unset($customerInfo['cartId']);

		$modelOrder->setData($customerInfo);
		$modelOrder->customerId = $cart->customerId;
		$modelOrder->paymentMethodId = $paymentData['method'];
		$modelOrder->shippingMethodId = $shippingData['0'];
		$modelOrder->shippingAmount = $shippingData['1'];
		$modelOrder->grandTotal = $cartSummary['grandTotal'];
		$modelOrder->discount = $cartSummary['discount'];
		$modelOrder->createdAt = date('Y-m-d');
		$orderId = $modelOrder->save();


		$cartItems = $cart->getCartItem();
		foreach ($cartItems as $item) 
		{
			# code...
			$modelOrderItem = Ccc::getModel("Order_Item");
			$modelOrderItem->itemId = $item->id;
			$modelOrderItem->orderId = $orderId;
			$modelOrderItem->productId = $item->productId;
			$modelOrderItem->name = $item->productName;
			$modelOrderItem->sku = Ccc::getModel("Product")->load($item->productId)->sku;
			$modelOrderItem->cost = $item->price;
			$modelOrderItem->price = $item->price;
			$modelOrderItem->discount = $item->discount;
			$modelOrderItem->quantity = $item->quantity;
			$modelOrderItem->createdAt = date('Y-m-d');     print_r($modelOrderItem);
			$modelOrderItem->save();

		}

		$modelOrderAddress = Ccc::getModel("Order_Address");

		unset($billingData['customerId']);
		$modelOrderAddress->setData($billingData);
		$modelOrderAddress->setData($customerInfo);
		$modelOrderAddress->orderId = $orderId;
		$modelOrderAddress->same = (isset($billingData['same'])) ? 1 : 2 ;   print_r($modelOrderAddress);
		$modelOrderAddress->save();



		$modelOrderAddress = Ccc::getModel("Order_Address");

		unset($shippingInfo['customerId']);
		$modelOrderAddress->setData($shippingInfo);
		$modelOrderAddress->setData($customerInfo);
		$modelOrderAddress->orderId = $orderId;
		$modelOrderAddress->same = (isset($billingData['same'])) ? 1 : 2 ;   print_r($modelOrderAddress);
		$modelOrderAddress->save();




	}


	public function orderGridAction()
	{
		# code...
		try 
		{
			$orderId = $this->getRequest()->getRequest('orderId'); 
			$blockOrderGrid = Ccc::getBlock("Order_Grid")->setData(['orderId' => $orderId]);
			$this->getLayout()->getContent()->setChild($blockOrderGrid);
			$this->renderLayout();
		} 
		catch (Exception $e) 
		{
			echo $msg = $e->getMessage();	exit();
		}
	}


}


?>