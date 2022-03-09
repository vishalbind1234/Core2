
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
				<?php foreach($page->getData() as $key => $value) : ?>

					<td> <?php echo($value);  ?> </td>

				<?php endforeach ; ?>        

				<td> <a href="<?php echo($this->getUrl('edit' , 'Page' , ['id' => $page->id ])); ?>" > Edit  </a> </td>  
				<td> <a href="<?php echo($this->getUrl('delete' , 'Page' , ['id' => $page->id ])); ?>" > Delete </a> </td>  
			</tr>
		<?php endforeach ; ?>                     
	<?php endif ;  ?>

</table>	
	