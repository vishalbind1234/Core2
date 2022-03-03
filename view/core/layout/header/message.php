
<h>message template</h3>

<?php foreach($this->getMessage()->getMessages() as $key => $value) : ?>
	
	<h2><?php echo($key . " => ");  print_r($value) ; ?></h2>

<?php endforeach ; ?>

