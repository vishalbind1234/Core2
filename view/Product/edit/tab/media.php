
<?php   $productMedia = $this->getCurrentProductMedia();   /* $productMedia = null ;  */  /*print_r($productMedia);   exit(); */  ?>


<table>
	<tr>
		<button type="button" id="cancel-button" value="<?php  echo $this->getUrl('index', 'Product'); ?>"> Cancel </button> 
		<button type="button" id="update-button" value="<?php echo $this->getUrl('update', 'Product_Media'); ?>" > Update </button> 
	</tr>

	<tr>
		<th> ID           </th>
		<th> Product Id   </th>
		<th> Image Path   </th>
		<th> Image       </th>
		<th> Base        </th>
		<th> Thum        </th>
		<th> Small       </th>
		<th> gallary     </th>
		<th> remove      </th>
		<th> Status      </th>
	</tr>

	<?php if( !$productMedia ): ?>
		<tr>
			<td colspan="7"><label> No Records Found . </label></td>
		</tr>
	<?php else :  ?>
		
		<?php foreach($productMedia as $media) : ?> 
			<tr>
				
				<td> <input type="number" name='media[id][]' value="<?php echo($media->id); ?>" readonly > </td>
				<td> <input type="number" name='media[productId][]' value="<?php echo($media->productId); ?>" readonly > </td>
				<td> <input type="text" name='media[image][]' value="<?php echo($media->image); ?>" readonly > </td>

				<td> <image class="img" src="<?php echo $media->getImageUrl($media->image); ?>"> </td>

				<td> <input type="radio" name='media[base]' value="<?php echo($media->id); ?>"  <?php if($media->base == 1){echo('checked');} ?>  > </td>
				<td> <input type="radio" name='media[thum]' value="<?php echo($media->id); ?>"  <?php if($media->thum == 1){echo('checked');}  ?>  > </td>
				<td> <input type="radio" name='media[small]' value="<?php echo($media->id); ?>"  <?php if($media->small == 1){echo('checked');} ?>  > </td>

				<td> <input type="checkbox" name='media[gallary][]' value="<?php echo($media->id); ?>"  <?php if($media->gallary == 1){echo('checked');} ?>  > </td>
				<td> <input type="checkbox" name='media[remove][]' value="<?php echo($media->id); ?>"  > </td>
				
				<td> 
					<select name='media[status][]'> 
						<?php foreach ($media->getStatus() as $key => $value) : ?>
							<option value="<?php echo($key); ?>" > <?php echo($value); ?> </option>
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
					<a href="<?php echo $this->getUrl('addProduct', 'Product_Media', ['id' => $media->productId ]); ?>" ><button type="button" >Add Image</button></a>
				</td>
			</tr>

	</table>
	

<script type="text/javascript">
	
	jQuery("#cancel-button").click(function(){

		var url = jQuery(this).val();
		admin.setUrl(url);
		admin.load();

	});

	jQuery("#update-button").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.setData(jQuery("#edit-form").serializeArray());
		admin.load();

	});

	
</script>


