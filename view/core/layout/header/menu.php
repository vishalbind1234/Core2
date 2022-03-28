
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link"  href="index.php?a=grid&c=Category">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?a=grid&c=Customer">Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?a=grid&c=Product">Product</a>
        </li>
         <li class="nav-item">
          <a class="nav-link active " href="index.php?a=grid&c=Admin">Admin</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="index.php?a=grid&c=Config">Config</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="index.php?a=grid&c=Vendor">Vendor</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="index.php?a=grid&c=Salesman">Salesman</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="index.php?a=grid&c=Page">Page</a>
        </li>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="<?php echo($this->getUrl('logout', 'Admin_Login' )); ?>">LOGOUT</a>
        </li>

        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- <table>
	<tr>
		<td>  <button> <a href="index.php?a=grid&c=Category"> Category  </a>  </button> </td>     
		<td>  <button> <a href="index.php?a=grid&c=Customer"> Customer  </a>  </button> </td>  
		<td>  <button> <a href="index.php?a=grid&c=Product">  Product   </a>  </button> </td>  
		<td>  <button> <a href="index.php?a=grid&c=Admin">    Admin     </a>  </button> </td> 
		<td>  <button> <a href="index.php?a=grid&c=Config">   Config    </a>  </button> </td> 
		<td>  <button> <a href="index.php?a=grid&c=Vendor">   Vendor    </a>  </button> </td> 
		<td>  <button> <a href="index.php?a=grid&c=Salesman"> SalesMan  </a>  </button> </td> 
		<td>  <button> <a href="index.php?a=grid&c=Page">     Page	   </a>   </button> </td> 
	</tr>
	<tr>
		<td> <a href="<?php //echo($this->getUrl('logout', 'Admin_Login' )); ?>"><h2>LOGOUT</h2></a> </td>
	</tr>
</table> -->

