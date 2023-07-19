<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <!-- Bootstrap -->
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  rel="stylesheet" type = "text/css"  href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <!-- Bootstrap include -->
  <style>
body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

.bg-image {
  /* The image used */
  background-image: url("back2.jpg");
  
  /* Add the blur effect */
  filter: blur(0px);
  -webkit-filter: blur(1px);
  
  /* Full height */
  height: 94%; 
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

</style>
 </head>
    <body>    <!--Navbar Bootstrap-->
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand"aria-current="page" href="index.php">Dada  Bhai  Noorejee  Electronics</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="inventory.php">Inventory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="orders.php">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="uploadSales.php">Sales</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="uploadOrderDetails.php">Orders Info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="SalesReports.php">Annual Sales</a>
        </li>
        <li class="nav-item">
        <a style="border: 2px solid white; border-radius: 15px;" onMouseOver="this.style.background='white',this.style.color='black'" 
          onMouseOut="this.style.background='black',this.style.color='white'";  class="nav-link active" href="signin.php">Sign Out</a>
        </li>
      </ul>
      &nbsp;
      &nbsp;
      &nbsp;
    
    
    </div>
    
  </div>
</nav>
<div class="bg-image"></div>
    </body>
</html>