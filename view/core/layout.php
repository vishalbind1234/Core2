<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<table>
		<tr>
			<td> <?php  $this->getHeader()->toHtml();  ?> </td>	
		</tr>

		<tr>
			<td> <?php  $this->getContent()->toHtml();  ?> </td>	
			
		</tr>
			<td> <?php  $this->getFooter()->toHtml();  ?> </td>	

		<tr>
			
		</tr>

	</table>

</body>
</html>