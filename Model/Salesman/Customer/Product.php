
<?php  Ccc::loadClass('Model_Core_Row');  ?>
<?php

class Model_Salesman_Customer_Product extends Model_Core_Row{

	protected $customer = null;

	public function __construct()
	{
		$this->setResourceName('Salesman_Customer_Product_Resource');
		parent::__construct();
	}

	
	public function getPrice($productId)
	{
		return $this->fetchRow("SELECT * FROM Salesman_Customer_Price WHERE salesmanId = {$this->getCustomer()->salesmanId} AND customerId = {$this->getCustomer()->id} AND productId = {$productId} ");
	}

	//----------------------------------------------------------------------

	/*public function getCustomer()
	{
		$modelCustomer = Ccc::getModel('Customer');
		if(!$this->id)
		{
			return $modelCustomer;
		}

		if($this->customer)
		{
			return $customer;
		}

		$customer = $modelCustomer->fetchAll("SELECT * FROM Customer WHERE salesmanId IN ({$this->id}, -1)");
		$this->setCustomer($customer);
		return $customer;
	}
	public function setCustomer(Model_Customer $customer)
	{
		$this->customer = $customer;
		return $this;
	}*/
	


}

?>