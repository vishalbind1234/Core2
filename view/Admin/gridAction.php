
<?php  $Admin =  $this->getAdmin();      ?>

<button><a href="<?php echo($this->getUrl('edit' , 'Admin' , [] , true)); ?>">Add New</a></button>

<table>

	<tr>
		<th>ID          </th>
		<th>First Name  </th>
		<th>Last Name   </th>
		<th>Email       </th>
		<th>Password      </th>
		<th>Status      </th>
		<th>CreatedAt   </th>
		<th>UpdatedAt   </th>

	</tr>

	<?php if(!$Admin): ?>
		<tr>
			<td colspan="8"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>

		</tr>

		<?php foreach($Admin as $admin) : ?>  <!-- -----------------for table data------------- -->
			<tr>
				<td> <?php echo $admin->id;  ?>  </td>
				<td> <?php echo $admin->firstName;  ?>  </td>
				<td> <?php echo $admin->lastName;  ?>  </td>
				<td> <?php echo $admin->email;  ?>  </td>
				<td> <?php echo $admin->password;  ?>  </td>
				<td> <?php $array = $admin->getStatus(); echo $array[$admin->status]; ?>  </td>
				<td> <?php echo $admin->createdAt;  ?>  </td>
				<td> <?php echo $admin->updatedAt;  ?>  </td>

				<td> <a href="<?php echo($this->getUrl('edit' , 'Admin' , ['id' => $admin->id ] )); ?>" > Edit  </a></td> 
				<td> <a href="<?php echo($this->getUrl('delete' , 'Admin' , ['id' => $admin->id ] )); ?>" > Delete </a> </td> 
			</tr>
		<?php endforeach ; ?> 
		<tr>
			<td> <a href="<?php echo($this->getUrl('grid', 'Admin' , ['currentPage' =>  $this->getPager()->getStart() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>Start</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Admin' , ['currentPage' =>  $this->getPager()->getPrev() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getPrev() == null){echo('disabled');} ?> >Prev</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Admin' , ['currentPage' =>  $this->getPager()->getCurrent() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button>Current</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Admin' , ['currentPage' =>  $this->getPager()->getNext() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getNext() == null){echo('disabled');} ?> >Next</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Admin' , ['currentPage' =>  $this->getPager()->getEnd() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>End</button></a> </td>
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
		
	