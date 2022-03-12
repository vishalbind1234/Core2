
<?php   $pages = $this->getPage();    /*print_r($pages);   exit();*/  ?>    

<button><a href="<?php echo($this->getUrl('edit'  , 'Page' , [] , true)); ?>"> Add New </a></button>

<table>

	<tr>
		<th>ID     	</th>
		<th>Name  	</th>
		<th>Code   	</th>
		<th>Content </th>
		<th>Status 	</th>
		<th>CreatedAt  </th>
		<th>updatedAt  </th>

	</tr>

	<?php if(!$pages): ?>
		<tr>
			<td colspan="16"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>
		
		<?php foreach($pages as $page) : ?>  <!-- -----------------for table data------------- -->
			<tr>
				<?php foreach($page->getData() as $key1 => $value1) : ?>

					<?php  if($key1 == "status") :  ?>

						<?php foreach( $page->getStatus() as $key2 => $value2 ) :?>

							<?php if($value1 == $key2 ) : ?>

								<td> <option> <?php echo($value2); ?> </option> </td>

							<?php  endif  ; ?>

						<?php endforeach ;  ?>

					<?php else : ?>

						<td> <?php echo($value1);  ?> </td>

					<?php endif ; ?>

				<?php endforeach ; ?>        

				<td> <a href="<?php echo($this->getUrl('edit' , 'Page' , ['id' => $page->id ])); ?>" > Edit  </a> </td>  
				<td> <a href="<?php echo($this->getUrl('delete' , 'Page' , ['id' => $page->id ])); ?>" > Delete </a> </td>  
			</tr>
		<?php endforeach ; ?>                     
	<?php endif ;  ?>
	<tr>
		<td> <a href="<?php echo($this->getUrl('grid', 'Page' , ['currentPage' =>  $this->getPager()->getStart() ])); ?>" ><button>Start</button></a> </td>
		<td> <a href="<?php echo($this->getUrl('grid', 'Page' , ['currentPage' =>  $this->getPager()->getPrev() ])); ?>" ><button <?php if($this->getPager()->getPrev() == null){echo('disabled');} ?> >Prev</button></a> </td>
		<td> <a href="<?php echo($this->getUrl('grid', 'Page' , ['currentPage' =>  $this->getPager()->getCurrent() ])); ?>" ><button>Current</button></a> </td>
		<td> <a href="<?php echo($this->getUrl('grid', 'Page' , ['currentPage' =>  $this->getPager()->getNext() ])); ?>" ><button <?php if($this->getPager()->getNext() == null){echo('disabled');} ?> >Next</button></a> </td>
		<td> <a href="<?php echo($this->getUrl('grid', 'Page' , ['currentPage' =>  $this->getPager()->getEnd() ])); ?>" ><button>End</button></a> </td>
	</tr>

</table>	
	