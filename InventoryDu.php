<?php
ob_start();
$con = new PDO("sqlite:Vehicles.db"); 
if (isset ($_POST['Delete'])) {
$del = unserialize($_POST['Delete']);
$query = "DELETE from $del[0] where $del[2] = $del[1];";
$stm=$con->prepare($query);
$stm->execute();
header("location:Upload$del[0].php?msg=success");
};
if (isset ($_POST['Update'])) {
    $up = unserialize($_POST['Update']);
    $query = "DELETE from $up[0] where $up[2] = $up[1] ";?>
    <!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="'https:// cdnjs.cloudflare.com/ajax/1ibs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.e.e/js/bootstrap.min.js"></script>
</head>
<body>
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
<?php 
    $query = "SELECT * from $up[0] where id = $up[1]";
    $stm=$con->prepare($query);
    $stm->execute();
    $data=$stm->fetchAll(PDO::FETCH_ASSOC);
    foreach($data as $res){
      ?>
      
      <div class="container w-50 m-auto">
      <br><br><br>
      <div class = "col-lg-10 m-auto d-block">
      <form action= "InventoryDu.php" method= "POST" enctype="multipart/form-data">
      <div class = "form-group">
            <label for = "phone">Product Id</label> 
              <input type="tel" name="id" value = <?php echo $res['id'];?> id = "user" class = "form-control" disabled>
              </div><br>
        <div class = "form-group">
            <label for = "user">Product name</label> 
              <input type="text" name="Name"  value = "<?php echo $res['name'];?>" id = "user" class = "form-control">
              </div><br>
        <div class = "form-group">
            <label for = "phone">Quantity</label> 
              <input type="tel" name="Quantity" value = <?php echo $res['Quantity'];?> id = "user" class = "form-control">
              </div><br>
        <div class = "form-group">
            <label for = "text">Description</label> 
              <input type="text" name="description" value = "<?php print_r($res['Description']);?>" class = "form-control" autocomplete="off">
              </div><br>
        <div class = "form-group">
            <label for = "phone">Unit Price</label> 
              <input type="tel" name="price" value = '<?php echo $res['Unit_Price'];?>' id = "user" class = "form-control">
              </div><br>
    <button type="submit" name = 'sub' value = <?php echo  $res['id'];?>  class="btn btn-dark"> Update </Button>
  </form>
  </div>
</div>
        <?php };};?>
        </tbody>
        </table>
        </div>
    </div>
</body>
</html>
<?php 
if (isset ($_POST['sub'])){
$id = $_POST['sub'];
$name = $_POST['Name'];
$desc = $_POST['description'];
$qty=$_POST['Quantity'];
$price=$_POST['price'];
$query = "Update inventory 
        SET name='$name',
          Quantity='$qty',
          Description='$desc',
          Unit_Price='$price' 
        where id = '$id'";
$stm=$con->prepare($query);
$stm->execute();

ob_end_clean();
header("location:uploadInventory.php?msg=success");
};?>