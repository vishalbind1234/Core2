
<?php  Ccc::loadClass('Block_Core_Template'); ?>

<?php

class Block_Salesman_Edit_Tab_Product extends Block_Core_Template{

	protected $percentage = null;
	protected $salesmanId = null;
	protected $customerId = null;

	public function __construct()
	{
		# code...
		$this->setTemplate('view/Salesman/edit/tab/product.php');
		$this->setParams();
	}
	
	public function setParams()
	{																
		$salesman = Ccc::getRegistry('salesman');
		$this->salesmanId = $salesman->id;
		$this->percentage = $salesman->percentage;
		$this->customerId = Ccc::getModel("Core_Request")->getRequest("customerId");
		return $this;
	}

	public function getPriceRow($productId)
	{																																
		# code...
		$scp = Ccc::getModel("Salesman_Customer_Product");											
		$row = $scp->fetchRow(" SELECT * FROM Salesman_Customer_Price WHERE salesmanId = {$this->salesmanId} AND customerId = {$this->customerId} AND productId = {$productId} ");
		return $row;
	}

	public function getProducts()
	{
		$products = Ccc::getModel("Product")->fetchAll("SELECT * FROM Product");
		return $products;
	}



}








?>