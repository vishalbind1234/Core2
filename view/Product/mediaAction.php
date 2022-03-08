
<?php   $productMedia = $this->getCurrentProductMedia();   /* $productMedia = null ;  */  /*print_r($productMedia);   exit(); */  ?>
<style>
	table , tr , th ,td {
		border:2px solid red;
		border-collapse: collapse;
	
	}
	table{
		
		width:60%;

	}

	.img{
		width:50px;
		height:50px;
	}
</style>

<form action="<?php  echo($this->getUrl('update' , 'Product_Media')); ?>"  method="POST">

	<button><a href="<?php  echo($this->getUrl('grid' , 'Product')); ?>"> Cancel </a></button> <br>
	<button type="submit" value="submit" > Update </a></button> 

	<table>

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
					
					<td> <image class="img" src="<?php echo($media->image); ?>"> </td>

					<td> <input type="radio" name='media[base]' value="<?php echo($media->id); ?>"  <?php if($media->base == 1){echo('checked');} ?>  > </td>
					<td> <input type="radio" name='media[thum]' value="<?php echo($media->id); ?>"  <?php if($media->thum == 1){echo('checked');}  ?>  > </td>
					<td> <input type="radio" name='media[small]' value="<?php echo($media->id); ?>"  <?php if($media->small == 1){echo('checked');} ?>  > </td>

					<td> <input type="checkbox" name='media[gallary][]' value="<?php echo($media->id); ?>"  <?php if($media->gallary== 1){echo('checked');} ?>  > </td>
					<td> <input type="checkbox" name='media[remove][]' value="<?php echo($media->id); ?>"  > </td>
					
					<td> 
					<select name='media[status][]'> 
						<?php foreach ($this->getStatus() as $key => $value) : ?>
							<option value="<?php echo($key); ?>" > <?php echo($value); ?> </option>
						<?php endforeach ; ?>
					</select> 
					</td>

				</tr>
			<?php endforeach ; ?>

		<?php endif ;  ?>

	</table>	
</form>


<?php if( $productMedia ): ?>
	<form action="<?php echo( $this->getUrl('save' , 'Product_Media' , ['id' => $media->productId] )); ?>"  method="POST"   enctype="multipart/form-data"   >
		
		<table>
				
				<tr>
					<td> <input type="file" name="productImage" accept="image/*"  multiple   > BROWSE  </td> 
					<td> <input type="submit"  value="submit"> </td>
				</tr>

		</table>
		
	</form>
<?php endif ;  ?>
