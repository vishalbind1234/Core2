
<h1>hello from content</h1>

<?php foreach ($this->getChild() as $key => $value) : ?>
	<?php $value->toHtml(); ?>
<?php endforeach; ?>