
<h1>hello from header</h1>

<?php foreach ($this->getChild() as $key => $value) : ?>
	<?php echo $value->toHtml(); ?>
<?php endforeach; ?>


