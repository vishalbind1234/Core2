
<?php   $configs = $this->getConfig();    /*print_r($configs);   exit();*/  ?>    

<style>
	table , tr , th ,td {
		border:2px solid blue;
		border-collapse: collapse;
	
	}
	table{
		
		background:pink;
		width:90%;

	}
</style>

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
			<?php foreach($config->getData() as $key => $value) : ?>

				<td> <?php echo($value);  ?> </td>

			<?php endforeach ; ?>        

			<td> <a href="<?php echo($this->getUrl('edit' , 'Config' , ['id' => $config->id ])); ?>" > Edit  </a> </td>  
			<td> <a href="<?php echo($this->getUrl('delete' , 'Config' , ['id' => $config->id ])); ?>" > Delete </a> </td>  
		</tr>
	<?php endforeach ; ?>                     
<?php endif ;  ?>

</table>	
		
	