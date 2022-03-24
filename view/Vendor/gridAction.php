
<?php   $vendors = $this->getVendor();   /* print_r($vendors);   exit(); */ ?>

<button><a href="<?php echo($this->getUrl('edit'  , 'Vendor' , null , true)); ?>"> Add New </a></button>

<table>

	<tr>
		<th>ID          </th>
		<th>First Name  </th>
		<th>Last Name   </th>
		<th>Email       </th>
		<th>Mobile      </th>
		<th>Status      </th>
		<th>CreatedAt   </th>
		<th>UpdatedAt   </th>

		<th>AddressID   </th>
		<th>Vendor Id   </th>
		<th>Country     </th>
		<th>State       </th>
		<th>City        </th>
		<th>Pincode     </th>
	</tr>

	<?php if(!$vendors): ?>
		<tr>
			<td colspan="16"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>
		
		<?php foreach($vendors as $vendor) : ?>  <!-- -----------------for table data------------- -->
			<tr>
				<td> <?php echo $vendor->id;  ?>  </td>
				<td> <?php echo $vendor->firstName;  ?>  </td>
				<td> <?php echo $vendor->lastName;  ?>  </td>
				<td> <?php echo $vendor->email;  ?>  </td>
				<td> <?php echo $vendor->mobile;  ?>  </td>
				<td> <?php $array = $vendor->getStatus(); echo $array[$vendor->status]; ?>  </td>
				<td> <?php echo $vendor->createdAt;  ?>  </td>
				<td> <?php echo $vendor->updatedAt;  ?>  </td>
				

				<?php  $address = $vendor->getAddress(); ?>   
				<td> <?php echo $address->id; 			?> </td>
				<td> <?php echo $address->vendorId;	 	?> </td>
				<td> <?php echo $address->pincode;      ?> </td>
				<td> <?php echo $address->city;         ?> </td>
				<td> <?php echo $address->state;        ?> </td>
				<td> <?php echo $address->country;      ?> </td>

				<td> <a href="<?php echo($this->getUrl('edit' , 'Vendor' , ['id' => $vendor->id ])); ?>" > Edit  </a> </td>  
				<td> <a href="<?php echo($this->getUrl('delete' , 'Vendor' , ['id' => $vendor->id ])); ?>" > Delete </a> </td>  

			</tr>
		<?php endforeach ; ?> 
		<tr>
			<td> <a href="<?php echo($this->getUrl('grid', 'Vendor' , ['currentPage' =>  $this->getPager()->getStart() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>Start</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Vendor' , ['currentPage' =>  $this->getPager()->getPrev() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getPrev() == null){echo('disabled');} ?> >Prev</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Vendor' , ['currentPage' =>  $this->getPager()->getCurrent() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button>Current</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Vendor' , ['currentPage' =>  $this->getPager()->getNext() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getNext() == null){echo('disabled');} ?> >Next</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Vendor' , ['currentPage' =>  $this->getPager()->getEnd() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>End</button></a> </td>
		</tr>
		<tr>
			<td>
				<form name="myForm" action="<?php echo($this->getUrl('grid','Vendor')); ?>" method="post">
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
