<?php   $pages = $this->getPage();    /*print_r($pages);   exit();*/  ?>    

<button><a href="<?php echo($this->getUrl('edit'  , 'Page' , [] , true)); ?>"> Add New </a></button>

<table>
	<form id="form-1" action="<?php echo $this->getUrl("multipleDelete" , "Page"); ?>" method="post" >
		<tr>
			<th>     	</th>
			<th>ID     	</th>
			<th>Name  	</th>
			<th>Code   	</th>
			<th>Content </th>
			<th>Status 	</th>
			<th>CreatedAt  </th>
			<th>updatedAt  </th>

		</tr>
		<tr>
			<td>  <label id="delete" type="button"> DELETE ALL </label> <input id="selectAll" type="checkbox" name="Page[selectAll]" value="1" > </td>
		</tr>

		<?php if(!$pages): ?>
			<tr>
				<td colspan="7"><label> No Records Found . </label></td>
			</tr>
			
		<?php else :  ?>
			
			<?php foreach($pages as $page) : ?>  <!-- -----------------for table data------------- -->
				<tr>
						<td> <input type="checkbox" class="checked" name="Page[id][]" value="<?php echo $page->id; ?>" > </td>
					<td> <?php echo $page->id;  ?>  </td>
					<td> <?php echo $page->name;  ?>  </td>
					<td> <?php echo $page->code;  ?>  </td>
					<td> <?php echo $page->content;  ?>  </td>
					<td> <?php $array = $page->getStatus(); echo $array[$page->status]; ?>  </td>
					<td> <?php echo $page->createdAt;  ?>  </td>
					<td> <?php echo $page->updatedAt;  ?>  </td>

					<td> <a href="<?php echo($this->getUrl('edit' , 'Page' , ['id' => $page->id ])); ?>" > Edit  </a> </td>  
					<td> <a href="<?php echo($this->getUrl('delete' , 'Page' , ['id' => $page->id ])); ?>" > Delete </a> </td>  
				</tr>
			<?php endforeach ; ?>                     
		<?php endif ;  ?>
	</form>

		<tr>
			<td> <a href="<?php echo($this->getUrl('grid', 'Page' , ['currentPage' =>  $this->getPager()->getStart() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>Start</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Page' , ['currentPage' =>  $this->getPager()->getPrev() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getPrev() == null){echo('disabled');} ?> >Prev</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Page' , ['currentPage' =>  $this->getPager()->getCurrent() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button>Current</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Page' , ['currentPage' =>  $this->getPager()->getNext() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getNext() == null){echo('disabled');} ?> >Next</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Page' , ['currentPage' =>  $this->getPager()->getEnd() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>End</button></a> </td>
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
</table>	
	
<script type="text/javascript">
	
	$(document).ready(function(){

		$("#selectAll").click(function(){
			if(this.checked == true)
			{
				$(".checked").each(function(){
					this.checked = true;
				});
			}
			else
			{
				$(".checked").each(function(){
					this.checked = false;
				});
			}
		});

		$("#delete").click(function(){
			$("#form-1").submit();
		});

	});
	 
</script>