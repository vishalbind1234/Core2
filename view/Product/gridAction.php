
<?php    $products = $this->getProduct();  /*print_r($products);  exit(); */  ?>

<button><a href="<?php  echo($this->getUrl('edit' , 'Product' , [] , true )); ?>" >  Add New  </a></button>

<table>


		<tr>
			<th>ID           </th>
			<th>Product Name </th>
			<th>Price   	 </th>
			<th>Discount   	 </th>
			<th>Discount Mode	 </th>
			<th>Tax Percentage   </th>
			<th>Quantity     </th>
			<th>Status       </th>
			<th>CreatedAt    </th>
			<th>UpdatedAt    </th>
			<th>SKU   		 </th>
			<th>Base Image    </th>
			<th>Thumb Image    </th>
			<th>Small Image    </th>
		</tr>

	<?php if(!$products): ?>
		<tr>
			<td colspan="7"><label> No Records Found . </label></td>
		</tr>
	<?php else :  ?>

		<?php foreach($products as $product) : ?>  <!-- -----------------for table data------------- -->
			<tr>
				<?php $thumRow = $product->getThum($product->id);   ?>                    
				<?php $baseRow = $product->getBase($product->id);   ?>                    
				<?php $smallRow = $product->getSmall($product->id); ?>   

				<td> <?php echo($product->id ); ?> </td>  
				<td> <?php echo($product->name ); ?> </td>  
				<td> <?php echo($product->price ); ?> </td>  
				<td> <?php echo($product->discount); ?> </td>  
				<td> <?php echo($product->discountMode); ?> </td>  
				<td> <?php echo($product->taxPercentage."%"); ?> </td>  
				<td> <?php echo($product->quantity ); ?> </td>  

				<?php foreach( $product->getStatus() as $key2 => $value2 ) :?>
					<?php if($product->status == $key2 ) : ?>
						<td> <option> <?php echo($value2); ?> </option> </td>
					<?php  endif  ; ?>
				<?php endforeach ;  ?>
				
				<td> <?php echo($product->createdAt ); ?> </td>  
				<td> <?php echo($product->updatedAt ); ?> </td>  
				<td> <?php echo($product->sku ); ?> </td>  

				<td>  <image class="img" src="<?php echo $product->getImageUrl($product->getBase()->image); ?>" >  </td>  
				<td>  <image class="img" src="<?php echo $product->getImageUrl($product->getThum()->image); ?>" >  </td>  
				<td>  <image class="img" src="<?php echo $product->getImageUrl($product->getSmall()->image); ?>" >  </td>  
				
				<td> <a href="<?php  echo($this->getUrl('edit' , 'Product' , ['id' => $product->id ])); ?>" > Edit  </a> </td>  
				<td> <a href="<?php  echo($this->getUrl('delete' , 'Product' , ['id' => $product->id ])); ?>" > Delete  </a> </td>  
				<td> <a href="<?php  echo($this->getUrl('media' , 'Product_Media' , ['id' => $product->id ])); ?>" > Media  </a> </td>  
			</tr>
		<?php endforeach ; ?>  
		<tr>
			<td> <a href="<?php echo($this->getUrl('grid', 'Product' , ['currentPage' =>  $this->getPager()->getStart() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>Start</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Product' , ['currentPage' =>  $this->getPager()->getPrev() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getPrev() == null){echo('disabled');} ?> >Prev</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Product' , ['currentPage' =>  $this->getPager()->getCurrent() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button>Current</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Product' , ['currentPage' =>  $this->getPager()->getNext() , 'perPageCount' =>  $this->getPager()->getPerPageCount()])); ?>" ><button <?php if($this->getPager()->getNext() == null){echo('disabled');} ?> >Next</button></a> </td>
			<td> <a href="<?php echo($this->getUrl('grid', 'Product' , ['currentPage' =>  $this->getPager()->getEnd() , 'perPageCount' =>  $this->getPager()->getPerPageCount() ])); ?>" ><button>End</button></a> </td>
		</tr>
		<tr>
			<td>
				<form name="myForm" action="<?php echo($this->getUrl('grid','Product')); ?>" method="post">
					<select name="perPageCount"  onchange="this.form.submit()" >
						<option selected hidden value="<?php echo $this->getPager()->getPerPageCount(); ?>" > <?php echo $this->getPager()->getPerPageCount(); ?> </option>
						<?php foreach($this->getPager()->getPerPageCountOptions() as $key => $value) : ?>
							<option value="<?php echo($value); ?>" > <?php echo($value); ?> </option>
						<?php endforeach ; ?>
					</select>
				</form>
			</td>
		</tr>                   
	<?php endif ;  ?>

</table>	
