
<?php   $configs = $this->getConfig();    /*print_r($configs);   exit();*/  ?>    

<button><a href="<?php echo($this->getUrl('edit'  , 'Config' , [] , true)); ?>"> Add New </a></button>

<table>

	<tr>
		<th>ID     	</th>
		<th>Name  	</th>
		<th>Code   	</th>
		<th>Value  	</th>
		<th>Status 	</th>
		<th>CreatedAt  </th>

	</tr>

	<?php if(!$configs): ?>
		<tr>
			<td colspan="16"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>
		
		<?php foreach($configs as $config) : ?>  <!-- -----------------for table data------------- -->
			<tr>
				<td> <?php echo $config->id;  ?>  </td>
				<td> <?php echo $config->name;  ?>  </td>
				<td> <?php echo $config->code;  ?>  </td>
				<td> <?php echo $config->value;  ?>  </td>
				<td> <?php $array = $config->getStatus(); echo $array[$config->status]; ?>  </td>
				<td> <?php echo $config->createdAt;  ?>  </td>

				<td> <a href="<?php echo($this->getUrl('edit' , 'Config' , ['id' => $config->id ])); ?>" > Edit  </a> </td>  
				<td> <a href="<?php echo($this->getUrl('delete' , 'Config' , ['id' => $config->id ])); ?>" > Delete </a> </td>  
			</tr>
		<?php endforeach ; ?> 
		<tr>
			<td> <a href="<?php echo($this->getUrl('grid', 'Config' , ['currentPage' =>  $this->getPager()->getStart() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>Start</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Config' , ['currentPage' =>  $this->getPager()->getPrev() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getPrev() == null){echo('disabled');} ?> >Prev</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Config' , ['currentPage' =>  $this->getPager()->getCurrent() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button>Current</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Config' , ['currentPage' =>  $this->getPager()->getNext() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getNext() == null){echo('disabled');} ?> >Next</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Config' , ['currentPage' =>  $this->getPager()->getEnd() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>End</button></a> </td>
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
		
	