<?php

Ccc::loadClass('Model_Core_Row');

class Model_Salesman extends Model_Core_Row {
	
	protected $customers = null;

	const ENABLE = 1;
	const ENABLE_LBL = 'ENABLE';
	const DISABLE = 2;
	const DISABLE_LBL = 'DISABLE';

	public function __construct()
	{
		$this->setResourceName('Salesman_Resource');					
	}

	public function getStatus()
	{
		$status = [ 
			self::ENABLE => self::ENABLE_LBL ,
			self::DISABLE => self::DISABLE_LBL
		];
		return $status;
	}


	public function getCustomers()
	{
		$modelCustomer = Ccc::getModel('Customer');
		if(!$this->id)
		{
			return [];
		}

		if($this->customers)
		{
			return $customers;
		}

		$customers = $modelCustomer->fetchAll("SELECT * FROM Customer WHERE salesmanId IN ({$this->id}, -1)");
		$this->setCustomers($customers);
		return $customers;
	}
	public function setCustomers(array $customers)
	{
		$this->customers = $customers;
		return $this;
	}
	


}


?>