<?php 


class Model_Core_Pager{

	protected $perPageCountOptions = [10 , 20 , 30 , 40 , 100 , 200];
	protected $perPageCount = 10;
	protected $totalCount = null;
	protected $pageCount = null;
	protected $start = null;
	protected $end = null;
	protected $startLimit = null;
	protected $endLimit = null;
	protected $current = 1;
	protected $prev = null;
	protected $next = null;

	public function execute($totalCount, $current)
	{
		$this->setTotalCount($totalCount);
		$this->setCurrent($current); 
		$this->setPageCount(ceil($this->getTotalCount() / $this->getPerPageCount() ));
		$this->setStart(1);
		$this->setEnd($this->getPageCount());
		$this->setNext( ($this->getCurrent() >= $this->getEnd() ) ? null : $this->getCurrent() + 1 );
		$this->setPrev( ($this->getCurrent() <= $this->getStart() ) ? null : $this->getCurrent() - 1 );

		$this->setStartLimit( ($this->getCurrent() - 1) * $this->getPerPageCount() + 1 ); 
		$this->setEndLimit( $this->getCurrent() * $this->getPerPageCount() );
		return $this;
	}

	public function setPerPageCountOptions(array $value)
	{
		# code...
		$this->perPageCountOptions = $value;
		return $this;
	}

	public function getPerPageCountOptions()
	{
		return $this->perPageCountOptions ;
	}


	public function setPerPageCount($value)
	{
		# code...
		$this->perPageCount = $value;
		return $this;
	}

	public function getPerPageCount()
	{
		return $this->perPageCount ;
	}

	public function setCurrent($value)
	{
		# code...
		$this->current = $value;
		return $this;
	}

	public function getCurrent()
	{
		return $this->current ;
	}

	public function setNext($value)
	{
		# code...
		$this->next = $value;
		return $this;
	}

	public function getNext()
	{
		return $this->next ;
	}

	public function setPrev($value)
	{
		# code...
		$this->prev = $value;
		return $this;
	}

	public function getPrev()
	{
		return $this->prev ;
	}

	public function setStart($value)
	{
		# code...
		$this->start = $value;
		return $this;
	}

	public function getStart()
	{
		return $this->start;
	}

	public function setEnd($value)
	{
		# code...
		$this->end = $value;
		return $this;
	}

	public function getEnd()
	{
		return $this->end;
	}

	public function setStartLimit($value)
	{
		# code...
		$this->startLimit = $value;
		return $this;
	}

	public function getStartLimit()
	{
		return $this->startLimit ;
	}

	public function setEndLimit($value)
	{
		# code...
		$this->endLimit = $value;
		return $this;
	}

	public function getEndLimit()
	{
		return $this->endLimit ;
	}

	public function setTotalCount($value)
	{
		# code...
		$this->totalCount = $value;
		return $this;
	}

	public function getTotalCount()
	{
		return $this->totalCount ;
	}

	public function setPageCount($value)
	{
		# code...
		$this->pageCount = $value;
		return $this;
	}

	public function getPageCount()
	{
		return $this->pageCount ;
	}


}





?>