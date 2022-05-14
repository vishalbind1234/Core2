
<nav aria-label="breadcrumb">
 	<ol class="breadcrumb">
		<?php foreach($this->getTab() as $key => $value) : ?>
	    	<li class="breadcrumb-item"><button type="button" class="tab-button" value="<?php echo $value['url']; ?>"> <?php echo $value['title']; ?> </button></li>
		<?php endforeach ; ?>
	</ol>
</nav>

<script type="text/javascript">
	
	jQuery(".tab-button").click(function(){
		
		var url = jQuery(this).val();
		admin.setUrl(url).load();
	});

</script>