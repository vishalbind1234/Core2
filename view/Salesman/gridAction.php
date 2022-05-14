
<?php   $salesmans = $this->getSalesman();   /* print_r($salesmans);   exit(); */ ?>

<button><a href="<?php echo($this->getUrl('edit'  , 'Salesman' , [] , true)); ?>"> Add New </a></button>

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
		<th>Percentage   </th>


	</tr>

	<?php if(!$salesmans): ?>
		<tr>
			<td colspan="8"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>
		
		<?php foreach($salesmans as $salesman) : ?>  <!-- -----------------for table data------------- -->
			<tr>

				<td> <?php echo $salesman->id;  ?>  </td>
				<td> <?php echo $salesman->firstName;  ?>  </td>
				<td> <?php echo $salesman->lastName;  ?>  </td>
				<td> <?php echo $salesman->email;  ?>  </td>
				<td> <?php echo $salesman->mobile;  ?>  </td>
				<td> <?php $array = $salesman->getStatus(); echo $array[$salesman->status]; ?>  </td>
				<td> <?php echo $salesman->createdAt;  ?>  </td>
				<td> <?php echo $salesman->updatedAt;  ?>  </td>
				<td> <?php echo $salesman->percentage;  ?>  </td>
			
				<td> <a href="<?php echo($this->getUrl('edit' , 'Salesman' , ['id' => $salesman->id ])); ?>" > Edit  </a> </td>  
				<td> <a href="<?php echo($this->getUrl('delete' , 'Salesman' , ['id' => $salesman->id ])); ?>" > Delete </a> </td>  
				<td> <a href="<?php echo($this->getUrl('grid' , 'Salesman_Customer' , ['id' => $salesman->id , 'percentage' => $salesman->percentage] )); ?>" > Manage Customers </a> </td>  

			</tr>
		<?php endforeach ; ?> 
		<tr>
			<td> <a href="<?php echo($this->getUrl('grid', 'Salesman' , ['currentPage' =>  $this->getPager()->getStart() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>Start</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Salesman' , ['currentPage' =>  $this->getPager()->getPrev() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getPrev() == null){echo('disabled');} ?> >Prev</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Salesman' , ['currentPage' =>  $this->getPager()->getCurrent() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button>Current</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Salesman' , ['currentPage' =>  $this->getPager()->getNext() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getNext() == null){echo('disabled');} ?> >Next</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Salesman' , ['currentPage' =>  $this->getPager()->getEnd() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>End</button></a> </td>
		</tr> 
		<tr>
			<td>
				<form name="myForm" action="<?php echo($this->getUrl('grid','Salesman')); ?>" method="post">
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
		
	