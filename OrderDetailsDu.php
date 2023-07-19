<?php
ob_start();
$con = new PDO("sqlite:Vehicles.db"); 
if (isset ($_POST['Delete'])) {
$del = unserialize($_POST['Delete']);
$query= "select * from '$del[0]' where Oid = '$del[1]' and Pid = '$del[2]'";
$stm=$con->prepare($query);
$stm->execute();
$data=$stm->fetchAll(PDO::FETCH_ASSOC);
$Od_qty=$data[0]['Quantity'];
$query= "select * from Inventory where id = '$del[2]'";
$stm=$con->prepare($query);
$stm->execute();
$data=$stm->fetchAll(PDO::FETCH_ASSOC);
$check=count($data);
if($check >= 1){
    $inv_qty=$data[0]['Quantity'];  
    $qtyt=$Od_qty+$inv_qty;
    $query = "Update inventory  SET  Quantity='$qtyt'
    where id = '$del[2]'";
    $stm=$con->prepare($query);
    $stm->execute();
}
else{
    $query="insert into inventory select Pid,Pname,Quantity,Price,Description from OrderDetails where Oid = '$del[1]' and Pid = '$del[2]'";
    $stm=$con->prepare($query);
    $stm->execute();
}
$query = "DELETE from $del[0] where Oid = '$del[1]' and Pid = '$del[2]'";
$stm=$con->prepare($query);
$stm->execute();
header("location:Upload$del[0].php?msg='success'");
};
if (isset ($_POST['Update']) or (isset($_GET["msg2"]))){
    if (isset ($_POST['Update'])){
    $up = unserialize($_POST['Update']);}

    if (isset($_GET["msg2"])){
        $up= explode(",",$_GET["msg2"]);
        } ?>
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
          <a class="nav-link" href="inventory.php">Inventory</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="orders.php">Orders</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="uploadSales.php">Sales</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="uploadOrderDetails.php">Orders Info</a>
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
    $query = "SELECT * from $up[0] where Oid = '$up[1]' and Pid = '$up[2]'";
    $stm=$con->prepare($query);
    $stm->execute();
    $data=$stm->fetchAll(PDO::FETCH_ASSOC);
    $Oid=strval($data[0]['Oid']);
    $Pid =strval($data[0]['Pid']);
    $val = $Oid.','.$Pid ;
    foreach($data as $res){
      ?>
      <div class="container w-50 m-auto">
      <br><br><br>
      <div class = "col-lg-10 m-auto d-block">
      <form action= "OrderDetailsDu.php" method= "POST" enctype="multipart/form-data">
            <div class = "form-group">
            <label for = "number">Order Id</label> 
              <input type="tel" name="Oid" value = <?php echo $res['Oid'];?> id = "user" class = "form-control" readonly>
              </div><br>

              <div class = "form-group">
            <label for = "number">Product Id</label> 
              <input type="tel" name="Pid" value = <?php echo $res['Pid'];?> id = "user" class = "form-control" readonly>
              </div><br>

              <div class = "form-group">
            <label for = "text">Product Name</label> 
              <input type="tel" name="Pid" value = "<?php echo $res['Pname'];?>" id = "user" class = "form-control" readonly>
              </div><br>

            <div class = "form-group">
            <label for = "phone">Quantity</label> 
              <input type="tel" name="Quantity" value = <?php echo $res['Quantity'];?> id = "user" class = "form-control">
              </div><br>
    <button type="submit" name = 'sub' value = <?php echo $val;?>  class="btn btn-dark"> Update </Button>
  </form>
  <?php
  if (isset($_GET["msg2"])){
        echo "<br>";

        if ($up["3"] == 'failed1') {
echo "<b><p>Product doesn't have that much Quantity!!</p></b>";

} 
};
?>
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
$up= explode(",",$_POST['sub']);
$Oid=(int)$up[0];
$Pid=(int)$up[1];
$qty=$_POST['Quantity'];    
$query= "select * from Inventory where id='$Pid'";
$stm=$con->prepare($query);
$stm->execute();
$data=$stm->fetchAll(PDO::FETCH_ASSOC);
print_r($data);
$inv_qty=$data[0]['Quantity'];
$check=count($data);
$query = "SELECT * from OrderDetails where Oid = '$Oid' and Pid='$Pid'";
$stm=$con->prepare($query);
$stm->execute();
$data=$stm->fetchAll(PDO::FETCH_ASSOC);
$Od_qty=$data[0]['Quantity'];
$update_Od=$Od_qty-$qty;
if ($update_Od>=0){
    $query = "Update OrderDetails 
    SET Quantity='$qty'
    where Oid = '$Oid' and Pid='$Pid'";
    $stm=$con->prepare($query);
    $stm->execute();
    if ($check>=1){
        $update_inv=$inv_qty+$update_Od;
        $query = "Update inventory  SET  Quantity='$update_inv'
        where id = '$Pid'";
        $stm=$con->prepare($query);
        $stm->execute();
        
    }
    else{
        $query="insert into inventory select Pid,Pname,Quantity,Price,Description from OrderDetails where Oid = '$Oid' and Pid='$Pid'";
        $stm=$con->prepare($query);
        $stm->execute();
        $query = "Update inventory  SET  Quantity='$update_Od'
        where id = '$Pid'";
        $stm=$con->prepare($query);
        $stm->execute();
    }
    ob_end_clean();
    header("location:uploadOrderDetails.php?msg=success");
}
else{
    if ($check>=1){
        if ($inv_qty >= abs($update_Od)){
            $query = "Update OrderDetails 
            SET Quantity='$qty'
            where Oid = '$Oid' and Pid='$Pid'";
            $stm=$con->prepare($query);
            $stm->execute();
            $update_inv=$inv_qty-abs($update_Od);
            $query = "Update inventory  SET  Quantity='$update_inv'
            where id = '$Pid'";
            $stm=$con->prepare($query);
            $stm->execute();
            header("location:uploadOrderDetails.php?msg=success");
        }
        else{
            header("location:OrderDetailsDu.php?msg2=OrderDetails,$Oid,$Pid,failed1");
        }
    }
    else{
        header("location:OrderDetailsDu.php?msg2=OrderDetails,$Oid,$Pid,failed2");
    }

}
};?>