
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
				<?php foreach($config->getData() as $key1 => $value1) : ?>

					<?php  if($key1 == "status") :  ?>

						<?php foreach( $config->getStatus() as $key2 => $value2 ) :?>

							<?php if($value1 == $key2 ) : ?>

								<td> <option> <?php echo($value2); ?> </option> </td>

							<?php  endif  ; ?>

						<?php endforeach ;  ?>

					<?php else : ?>

						<td> <?php echo($value1);  ?> </td>

					<?php endif ; ?>	

				<?php endforeach ; ?>        

				<td> <a href="<?php echo($this->getUrl('edit' , 'Config' , ['id' => $config->id ])); ?>" > Edit  </a> </td>  
				<td> <a href="<?php echo($this->getUrl('delete' , 'Config' , ['id' => $config->id ])); ?>" > Delete </a> </td>  
			</tr>
		<?php endforeach ; ?>                     
	<?php endif ;  ?>

</table>	
		
	