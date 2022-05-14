

<form id="edit-form"  action="<?php echo $this->getUrl('save'); ?>" method="post" enctype="multipart/form-data" >
	<div> <?php echo $this->getTab()->toHtml(); ?> </div>
	<div> <?php echo $this->getTabContent()->toHtml(); ?> </div>
</form>

