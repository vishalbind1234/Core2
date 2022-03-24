
<?php  $categories =  $this->getCategory(); /* print_r($categories);  exit();*/  ?>

<BUTTON> <a href="<?php echo($this->getUrl('edit' , 'Category' , [] , true)); ?>"> Add New </a> </BUTTON> 

<table>

		<tr>
			<th> <label> ID </label> </th>
			<th> <label> Parent ID </label> </th>
			<th> <label> Whole Path </label> </th>
			<th> <label> Name </label> </th>
			<th> <label> Status </label> </th>
			<th> <label> CreatedAt </label> </th>
			<th> <label> UpdatedAt </label> </th>

			<th> <label> Thum  </label> </th>
			<th> <label> Base  </label> </th>
			<th> <label> Small </label> </th>
		</tr>

	<?php if(!$categories) : ?>
		<tr>
			<td colspan="6"> <label>No Data Found.</label> </td>
		</tr>
	<?php else : ?>

		<?php foreach( $categories as $key => $category ) : ?> <!-- ------------------------printing array data---------------- -->
			<tr>
				<td> <?php echo $category->id;  ?>  </td>
				<td> <?php echo $category->parentId;  ?>  </td>
				<td> <?php echo $this->wholePathName($category->id);  ?>  </td>
				<td> <?php echo $category->name;  ?>  </td>
				<td> <?php $array = $category->getStatus(); echo $array[$category->status]; ?>  </td>
				<td> <?php echo $category->createdAt;  ?>  </td>
				<td> <?php echo $category->updatedAt;  ?>  </td>
				
				<td>  <image class="img" src="<?php echo $category->getImageUrl($category->getThum()->image); ?>" >  </td>  
				<td>  <image class="img" src="<?php echo $category->getImageUrl($category->getBase()->image); ?>" >  </td>  
				<td>  <image class="img" src="<?php echo $category->getImageUrl($category->getSmall()->image); ?>" >  </td>  
				

				<td> <a href="<?php echo( $this->getUrl('edit'   , 'Category'       , ['id' => $category->id] ) ); ?>"  > Edit </a> </td>
				<td> <a href="<?php echo( $this->getUrl('delete' , 'Category'       , ['id' => $category->id] ) ); ?>"  > Delete </a> </td>
				<td> <a href="<?php echo( $this->getUrl('media'  , 'Category_Media' , ['id' => $category->id] ) ); ?>"  > Media </a> </td>
			</tr>
		<?php endforeach ;  ?>
		<tr>
			<td> <a href="<?php echo($this->getUrl('grid', 'Category' , ['currentPage' =>  $this->getPager()->getStart() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>Start</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Category' , ['currentPage' =>  $this->getPager()->getPrev() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getPrev() == null){echo('disabled');} ?> >Prev</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Category' , ['currentPage' =>  $this->getPager()->getCurrent() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button>Current</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Category' , ['currentPage' =>  $this->getPager()->getNext() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getNext() == null){echo('disabled');} ?> >Next</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Category' , ['currentPage' =>  $this->getPager()->getEnd() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>End</button></a> </td>
		</tr>
		<tr>
			<td>
				<form name="myForm" action="<?php echo($this->getUrl('grid','Category')); ?>" method="post">
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

