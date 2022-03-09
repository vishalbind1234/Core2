<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		table , tr , td , th 
		{
			border: 2px solid grey ;
			border-collapse: collapse;
		}

		table
		{
			width:90%;
		}

		img
		{
			height: 30px;
			width: 30px;
		}
	</style>
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