
<?php $products = $this->getProductList(); ?>
<div id="product-list" class="row-lg-12" >
	<table id="product-list" class="table" >
		<tr>
			<td><label> Products : </label></td>
		</tr>
		<tr>
			<td><button type="button" onClick="document.getElementById('product-list').style.display='none'" > Cancel </button></td>
		</tr>
		<tr>
			<th>ProductID</th>
			<th>Name</th>
			<th>Image</th>
			<th>Price</th>
			<th>Tax Percentage</th>
			<th>Add</th>
		</tr>
		<?php if(!$products) : ?>
			<tr>
				<td colspan="6"> No records . </td>
			</tr>
		<?php else : ?>
			<?php foreach($products as $key => $product) : ?>
				
				<tr>
					<td class="text-center" > <?php echo $product->id ?> </td>
					<td> <?php echo $product->name ?>  </td>
					<td> <image class="img"   src="<?php echo $product->getImageUrl($product->getThum()->image); ?>">  </td>
					<td> <?php echo $product->getFinalPrice(); ?> </td>
					<td> <?php echo $product->taxPercentage ?> </td>
					<td> <input type="checkbox" name=Cart[ProductGrid][ProductId][] value="<?php echo $product->id; ?>" > </td>
				</tr>

			<?php endforeach ; ?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><button type="button" id="add-item" value="<?php echo $this->getUrl('addProduct', 'Cart'); ?>" > SAVE </button></td>
			</tr>
		<?php endif; ?>
	</table>
</div>



<script type="text/javascript">
	

	jQuery("#add-item").click(function(){

		admin.setUrl(jQuery(this).val());
		admin.setData(jQuery("#cart-form").serializeArray());
		admin.load();

	});

	
</script>