
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
	<?php foreach($this->getTab() as $key => $value) : ?>
    	<li class="breadcrumb-item"><a href="<?php echo $value['url']; ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach ; ?>
	</ol>
</nav>