
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
				
				<?php foreach( $category->getData() as $key1 => $value1 ) : ?>

					<?php  if($key1 == "status") :  ?>

						<?php foreach( $category->getStatus() as $key2 => $value2 ) :?>

							<?php if($value1 == $key2 ) : ?>

								<td> <option> <?php echo($value2); ?> </option> </td>

							<?php  endif  ; ?>

						<?php endforeach ;  ?>

					<?php  elseif( $key1 == "wholePath" ) :  ?>

						<td> <?php echo( $this->wholePathName( $category->id ) ); ?>   </td>

					<?php  else :  ?>

						<td> <?php echo($value1); ?> </td>

					<?php  endif  ; ?>

				<?php endforeach ;  ?>

				<?php $thumRow = $category->getThum($category->id);   ?>                    
				<?php $baseRow = $category->getBase($category->id);   ?>                    
				<?php $smallRow = $category->getSmall($category->id); ?> 

				<td>  <image class="img" src="<?php echo($baseRow->image); ?>" >  </td>  
				<td>  <image class="img" src="<?php echo($thumRow->image); ?>" >  </td>  
				<td>  <image class="img" src="<?php echo($smallRow->image); ?>" >  </td>  
				

				<td> <a href="<?php echo( $this->getUrl('edit'   , 'Category'       , ['id' => $category->id] ) ); ?>"  > Edit </a> </td>
				<td> <a href="<?php echo( $this->getUrl('delete' , 'Category'       , ['id' => $category->id] ) ); ?>"  > Delete </a> </td>
				<td> <a href="<?php echo( $this->getUrl('media'  , 'Category_Media' , ['id' => $category->id] ) ); ?>"  > Media </a> </td>
			</tr>
		<?php endforeach ;  ?>

	<?php endif ;  ?>


 </table>

