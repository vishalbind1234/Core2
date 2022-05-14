
<h1>Content</h1>

<?php foreach ($this->getChild() as $key => $value) : ?>
	<?php/* print_r($value) ;*/ ?>
	<?php echo $value->toHtml(); ?>
<?php endforeach; ?>