
<?php $media = $this->getMedia(); /*  print_r($media);  exit();*/ ?>
<?php  $categoryId = Ccc::getFront()->getRequest()->getRequest('id');   ?>

<form action="<?php  echo($this->getUrl('update' , 'Category_Media' , ['id' => $categoryId] )); ?>"  method="POST">

	<button><a href="<?php  echo($this->getUrl('grid' , 'Category')); ?>"> Cancel </a></button> <br>
	<button type="submit" value="submit" > Update </a></button> 

	<table>

		<tr>
			<th> ID           </th>
			<th> Category Id   </th>
			<th> Image Path   </th>
			<th> Image       </th>
			<th> Base        </th>
			<th> Thum        </th>
			<th> Small       </th>
			<th> gallary     </th>
			<th> remove      </th>
			<th> Status      </th>
		</tr>

		<?php if( !$media ): ?>
			<tr>
				<td colspan="10"><label> No Records Found . </label></td>
			</tr>
		<?php else :  ?>
			
			<?php foreach($media as $media) : ?> 
				<tr>

					<td> <input type="number" name='media[id][]' value="<?php echo($media->id); ?>" readonly > </td>
					<td> <input type="number" name='media[categoryId][]' value="<?php echo($media->categoryId); ?>" readonly > </td>
					<td> <input type="text" name='media[image][]' value="<?php echo($media->image); ?>" readonly > </td>
					
					<td> <image class="img" src="<?php echo($media->image); ?>"> </td>

					<td> <input type="radio" name='media[base]' value="<?php echo($media->id); ?>"  <?php if($media->base == 1){echo('checked');} ?>  > </td>
					<td> <input type="radio" name='media[thum]' value="<?php echo($media->id); ?>"  <?php if($media->thum == 1){echo('checked');}  ?>  > </td>
					<td> <input type="radio" name='media[small]' value="<?php echo($media->id); ?>"  <?php if($media->small == 1){echo('checked');} ?>  > </td>

					<td> <input type="checkbox" name='media[gallary][]' value="<?php echo($media->id); ?>"  <?php if($media->gallary== 1){echo('checked');} ?>  > </td>
					<td> <input type="checkbox" name='media[remove][]' value="<?php echo($media->id); ?>"  > </td>
					
					<td> 
					<select name='media[status][]' > 
						<?php foreach ($this->getStatus() as $key => $value) : ?>
							<option value="<?php if($key == '1'){echo($media->id);} ?>"  <?php if($media->status == $key){echo('selected');} ?> >  <?php echo($value); ?> </option>
						<?php endforeach ; ?>
					</select> 
					</td>

				</tr>
			<?php endforeach ; ?>

		<?php endif ;  ?>

	</table>	
</form>


<form action="<?php echo( $this->getUrl('save' , 'Category_Media' , ['id' => $categoryId] )); ?>"  method="POST"   enctype="multipart/form-data"   >
	
	<table>
			
			<tr>
				<td> <input type="file" name="categoryImage" accept="image/*"  multiple > BROWSE  </td> 
				<td> <input type="submit"  value="submit"> </td>
			</tr>

	</table>
	
</form>
