
<div id="indexContent">
	<table class="table" >
		<tr>
			<td><button type="button" id="addNew" value="<?php echo $this->getAddNewUrl(); ?>" >Add New</button></td>
		</tr>

		<tr style="color:black; border:2px solid black; border-collapse: collapse; " >
			<?php foreach($this->getColumn() as $key => $value) : ?>
				<td>
					<label > <?php echo $value['title']; ?> </label>
				</td>
			<?php endforeach ; ?>
		</tr>

		<!-- -----------retrive address   if(row->getBillingAddress()->id)  print address details------------------------- -->

		<?php foreach($this->getCollection() as $row) : ?>
			<tr style="color:blue; " >
				<?php foreach($row->getData() as $key => $value) : ?>
					<td  style="color:blue; border:2px solid grey; border-collapse: collapse; " >
						<label> <?php echo $this->getColumnValue($key,$value,$row) ; ?> </label>
					</td>
				<?php endforeach ; ?>
				<!-- -------------------------------------------------------------------- -->
				<?php foreach($this->getAction() as $key => $value) : ?>
					<td>
						<button type="button" class="<?php echo $value['action']; ?>" value="<?php $method = $value['method']; echo $this->$method($row->id); ?>" > 	<?php echo $value['action']; ?> 
						</button> 
					</td>
				<?php endforeach ; ?>
			</tr>
		<?php endforeach ; ?>
		<tr>
			<!-- ------------------------------------------------------------------------------------------------------------------------ -->
			<td> <button onclick="admin.setUrl('<?php echo $this->getUrl('index', null, ['currentPage' =>  $this->getPager()->getStart(), 'perPageCount' =>  $this->getPager()->getPerPageCount()]); ?>').load()" > Start </button></a> </td>

			<td> <button onclick="admin.setUrl('<?php echo $this->getUrl('index', null, ['currentPage' =>  $this->getPager()->getPrev(), 'perPageCount' =>  $this->getPager()->getPerPageCount()]); ?>').load()" <?php if($this->getPager()->getPrev() == null){echo('disabled');} ?> > Prev </button></a> </td>
			
			<td> <button onclick="admin.setUrl('<?php echo $this->getUrl('index', null, ['currentPage' =>  $this->getPager()->getCurrent(),'perPageCount' =>  $this->getPager()->getPerPageCount()]); ?>').load()" > Current </button></a> </td>

			<td> <button onclick="admin.setUrl('<?php echo $this->getUrl('index', null, ['currentPage' =>  $this->getPager()->getNext() , 'perPageCount' =>  $this->getPager()->getPerPageCount()]); ?>').load()" <?php if($this->getPager()->getNext() == null){echo('disabled');} ?> > Next </button></a> </td>

			<td> <button onclick="admin.setUrl('<?php echo $this->getUrl('index', null, ['currentPage' =>  $this->getPager()->getEnd() , 'perPageCount' =>  $this->getPager()->getPerPageCount()]); ?>').load()" > End </button></a> </td>
		<!------------------------------------- --------------------------------------------------------------------------------------------->

		</tr> 
		<tr>
			<td>
				<form id="pagination-form" action="<?php echo($this->getUrl('index')); ?>" method="post">
					<select name="perPageCount"  id="page-select" >
						<option selected hidden value="<?php echo $this->getPager()->getPerPageCount(); ?>" > 
							<?php echo $this->getPager()->getPerPageCount(); ?> 
						</option>
						<?php foreach($this->getPager()->getPerPageCountOptions() as $key => $value) : ?>
							<option value="<?php echo($value); ?>" > <?php echo($value); ?> </option>
						<?php endforeach ; ?>
					</select>
				</form>
			</td>
		</tr> 

	</table>

	<div id="messageContent" >
		<h4>here we get message</h4>
	</div>

</div>



<script type="text/javascript">

	jQuery(".delete").click(function(){

		var url = jQuery(this).val();
		admin.setUrl(url).load();
	});

	jQuery(".edit").click(function(){

		var url = jQuery(this).val();
		admin.setUrl(url).load();
	});

	jQuery("#addNew").click(function(){

		var url = jQuery(this).val();
		admin.setUrl(url).load();	
	});

	jQuery("#page-select").change(function(){

		admin.paginationAction().load();

	});


</script>
