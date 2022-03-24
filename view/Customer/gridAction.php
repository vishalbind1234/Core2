<?php   $customers = $this->getCustomer();    /*print_r($customers);   exit();*/  ?>

<button><a href="<?php echo($this->getUrl('edit'  , 'Customer' , [] , true)); ?>"> Add New </a></button>

<table>

	<tr>
		<th>  <a href="<?php echo $this->getUrl("addNew", "Cart"); ?>"> <button > Order </button> </a>
 </th>
	</tr>

	<tr>
		<th>ID          </th>
		<th>First Name  </th>
		<th>Last Name   </th>
		<th>Email       </th>
		<th>Mobile      </th>
		<th>CreatedAt   </th>
		<th>UpdatedAt   </th>
		<th>Salesman ID   </th>

		<th>AddressID   </th>
		<th>Customer Id </th>
		<th>Address     </th>
		<th>Pincode     </th>
		<th>City        </th>
		<th>State       </th>
		<th>Country     </th>
		<th>Same        </th>
		<th>Address Type </th>
	</tr>

	<?php if(!$customers): ?>
		<tr>
			<td colspan="16"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>
		
		<?php foreach($customers as $customer) : ?>  <!-- -----------------for table data------------- -->
			<tr>

				<td> <?php echo $customer->id;  ?>  </td>
				<td> <?php echo $customer->firstName;  ?>  </td>
				<td> <?php echo $customer->lastName;  ?>  </td>
				<td> <?php echo $customer->email;  ?>  </td>
				<td> <?php echo $customer->mobile;  ?>  </td>
				<td> <?php echo $customer->createdAt;  ?>  </td>
				<td> <?php echo $customer->updatedAt;  ?>  </td>
				<td> <?php echo $customer->salesmanId; ?>  </td>

				<?php $address = $customer->getBillingAddress(); ?>
				<td> <?php echo $address->id; 			 ?> </td>
				<td> <?php echo $address->customerId;	 ?> </td>
				<td> <?php echo $address->address;      ?> </td>
				<td> <?php echo $address->pincode;      ?> </td>
				<td> <?php echo $address->city;         ?> </td>
				<td> <?php echo $address->state;        ?> </td>
				<td> <?php echo $address->country;      ?> </td>
				<td> <?php echo $address->same;         ?> </td>
				<td> <?php echo $address->addressType;  ?> </td>

				<td> <a href="<?php echo($this->getUrl('edit' , 'Customer' , ['id' => $customer->id ])); ?>" > Edit  </a> </td>  
				<td> <a href="<?php echo($this->getUrl('delete' , 'Customer' , ['id' => $customer->id ])); ?>" > Delete </a> </td>  
			</tr>
		<?php endforeach ; ?>  
		<tr>
			<td> <a href="<?php echo($this->getUrl('grid', 'Customer' , ['currentPage' =>  $this->getPager()->getStart() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>Start</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Customer' , ['currentPage' =>  $this->getPager()->getPrev() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getPrev() == null){echo('disabled');} ?> >Prev</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Customer' , ['currentPage' =>  $this->getPager()->getCurrent() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button>Current</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Customer' , ['currentPage' =>  $this->getPager()->getNext() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getNext() == null){echo('disabled');} ?> >Next</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Customer' , ['currentPage' =>  $this->getPager()->getEnd() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>End</button></a> </td>
		</tr> 
		<tr>
			<td>
				<form name="myForm" action="<?php echo($this->getUrl('grid')); ?>" method="post">
					<select name="perPageCount"  onchange="this.form.submit()" >
						<option selected hidden value="<?php echo $this->getPager()->getPerPageCount(); ?>" > <?php echo $this->getPager()->getPerPageCount(); ?> </option>
						<?php foreach($this->getPager()->getPerPageCountOptions() as $key => $value) : ?>
							<option value="<?php echo($value); ?>" > <?php echo($value); ?> </option>
						<?php endforeach ; ?>
					</select>
				</form>
			</td>
		</tr>                  
	<?php endif ;  ?>

</table>	
		
