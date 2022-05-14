
<h3>Message</h3>

<?php if($this->getMessage()->getMessages()) : ?>
	<?php foreach($this->getMessage()->getMessages() as $key => $value) : ?>
		
		<h6><?php echo($value) ; ?></h6>

	<?php endforeach ; ?>
	<?php $this->getMessage()->unsetMessages(); ?>
<?php endif ; ?>

