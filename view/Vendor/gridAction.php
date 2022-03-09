
<?php   $vendors = $this->getVendor();   /* print_r($vendors);   exit(); */ ?>

<button><a href="<?php echo($this->getUrl('edit'  , 'Vendor' , [] , true)); ?>"> Add New </a></button>

<table>

	<tr>
		<th>ID          </th>
		<th>First Name  </th>
		<th>Last Name   </th>
		<th>Email       </th>
		<th>Mobile      </th>
		<th>Status      </th>
		<th>CreatedAt   </th>
		<th>UpdatedAt   </th>

		<th>AddressID   </th>
		<th>Vendor Id   </th>
		<th>Country     </th>
		<th>State       </th>
		<th>City        </th>
		<th>Pincode     </th>
	</tr>

	<?php if(!$vendors): ?>
		<tr>
			<td colspan="16"><label> No Records Found . </label></td>
		</tr>
		
	<?php else :  ?>
		
		<?php foreach($vendors as $vendor) : ?>  <!-- -----------------for table data------------- -->
			<tr>
				<?php foreach($vendor->getData() as $key => $value) : ?>

					<?php if($key == 'status'): ?>
						<td>
							<select>
								<?php foreach($this->getStatus() as $key2 => $value2) : ?>

									<option <?php if($key2 == $value){echo('selected');} ?>  value="<?php echo($key2); ?>" > <?php echo($value2);  ?> </option>

								<?php endforeach; ?>
							</select>
						</td>
					<?php else : ?>
						<td> <?php echo($value);  ?> </td>
					<?php endif ; ?>	

				<?php endforeach ; ?>        

				<td> <a href="<?php echo($this->getUrl('edit' , 'Vendor' , ['id' => $vendor->id ])); ?>" > Edit  </a> </td>  
				<td> <a href="<?php echo($this->getUrl('delete' , 'Vendor' , ['id' => $vendor->id ])); ?>" > Delete </a> </td>  

			</tr>
		<?php endforeach ; ?>                     
	<?php endif ;  ?>

</table>	
