
<?php $medias = $this->getCurrentCategoryMedia(); /*  print_r($media);  exit();*/ ?>

<table>

<tr>
	<td><button type="button" id="submit-button" value="<?php echo $this->getUrl('update','Category_Media'); ?>"> Update </button></td>
	<td><button type="button" id="cancel-button" value="<?php echo $this->getUrl('index','Category'); ?>" > Cancel </button></td>
</tr>

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

	<?php if( !$medias ): ?>
		<tr>
			<td colspan="10"><label> No Records Found . </label></td>
		</tr>
	<?php else :  ?>
		
		<?php foreach($medias as $media) : ?> 
			<tr>

				<td> <input type="number" name='media[id][]' value="<?php echo($media->id); ?>" readonly > </td>
				<td> <input type="number" name='media[categoryId][]' value="<?php echo($media->categoryId); ?>" readonly > </td>
				<td> <input type="text" name='media[image][]' value="<?php echo($media->image); ?>" readonly > </td>
				
				<td> <image class="img" src="<?php echo $media->getImageUrl($media->image); ?>"> </td>

				<td> <input type="radio" name='media[base]' value="<?php echo($media->id); ?>"  <?php if($media->base == 1){echo('checked');} ?>  > </td>
				<td> <input type="radio" name='media[thum]' value="<?php echo($media->id); ?>"  <?php if($media->thum == 1){echo('checked');}  ?>  > </td>
				<td> <input type="radio" name='media[small]' value="<?php echo($media->id); ?>"  <?php if($media->small == 1){echo('checked');} ?>  > </td>

				<td> <input type="checkbox" name='media[gallary][]' value="<?php echo($media->id); ?>"  <?php if($media->gallary== 1){echo('checked');} ?>  > </td>
				<td> <input type="checkbox" name='media[remove][]' value="<?php echo($media->id); ?>"  > </td>
				
				<td> 
				<select name='media[status][]' > 
					<?php foreach ($media->getStatus() as $key => $value) : ?>
						<option value="<?php if($key == '1'){echo($media->id);} ?>"  <?php if($media->status == $key){echo('selected');} ?> >  <?php echo($value); ?> </option>
					<?php endforeach ; ?>
				</select> 
				</td>

			</tr>
		<?php endforeach ; ?>

	<?php endif ;  ?>

</table>	


<table>
			
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td>
			<a href="<?php echo $this->getUrl('addCategory', 'Category_Media', ['id' => $media->categoryId]); ?>" ><button type="button" >Add Image</button></a>
		</td>
	</tr>

</table>



<script type="text/javascript">
	
	jQuery("#cancel-button").click(function(){

		var url = jQuery(this).val();
		admin.setUrl(url).load();

	});

	jQuery("#submit-button").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.setData(jQuery("#edit-form").serializeArray());
		admin.load();

	});


	
	
</script>