

<form id="media-form" action="<?php echo $this->getUrl('save' , 'Category_Media' ); ?>"  method="POST" enctype="multipart/form-data" >
	
	<table>
			
			<tr>
				<td> <input type="file" name="categoryImage" multiple accept="image/*" > BROWSE </td> 
				<td> <button id="media-btn" type="submit" > Upload-Media </button> </td>
			</tr>

	</table>
	
</form>

