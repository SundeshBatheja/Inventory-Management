<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <!-- Bootstrap -->
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link  rel="stylesheet" type = "text/css"  href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="'https:// cdnjs.cloudflare.com/ajax/1ibs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.e.e/js/bootstrap.min.js"></script>
  <!-- Bootstrap include -->
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
          <a class="nav-link active" href="inventory.php">Inventory</a>
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
<br>
<div class="container w-50 m-auto">
<br><br><br>
<div class = "col-lg-10 m-auto d-block">
  <form action= "uploadInventory.php" method= "post" enctype="multipart/form-data">
  <div class = "form-group">
        <label for = "user">Product Name</label> 
          <input type="text" name="Username" id = "user" class = "form-control">
  </div><br>
    <div class = "form-group">
        <label for = "quantity">Quantity</label> 
          <input type="tel" name="Quantity" id = "user" class = "form-control">
    </div><br>
    <div class = "form-group">
      <label for = "text">Description</label> 
        <input type="tel" name="Description" id = "user" class = "form-control">
    </div><br>
    <div class = "form-group">
      <label for = "amount">Unit Price</label> 
        <input type="tel" name="price" id = "user" class = "form-control">
    </div><br>
        
    <input type="submit" name = 'submit' value = "Insert Product" class="btn btn-dark">
    &emsp;&emsp;
    <input type="submit" name = 'unsubmit' value = "Show Inventory" class="btn btn-dark">
  </form>
  <?php
echo "<br>";
        if (isset($_GET["msg"]) && $_GET["msg"] == 'success') {
          echo '<b>Product Added Successfully!</b>';

};
?>
  </div>
</div>
    </body>
</html>