<?php 
$con = new PDO("sqlite:Vehicles.db"); 
ob_start();
if(isset ($_POST['submit'])){
  $Pid = $_POST['Pid'];
  $Oid = $_POST['Oid'];
  $qty = $_POST['Quantity'];
  $query= "select * from Inventory where id='$Pid'";
  $stm=$con->prepare($query);
  $stm->execute();
  $data2=$stm->fetchAll(PDO::FETCH_ASSOC);
  $inv_qty=$data2[0]['Quantity'];
  $check=count($data2);
  if($check >= 1){
      if($inv_qty >= $qty){
          $ProdName=$data2[0]['name'];
          $Desc=$data2[0]['Description'];
          $price=$data2[0]['Unit_Price'];
          $query = "INSERT INTO OrderDetails(Oid,Pid,Pname,Quantity,Description,Price) values ('$Oid','$Pid','$ProdName','$qty','$Desc','$price')";
          $stm=$con->prepare($query);
          $stm->execute();
          $sume=$inv_qty-$qty;
          $query = "Update inventory  SET  Quantity='$sume'
          where id = '$Pid'";
          $stm=$con->prepare($query);
          $stm->execute();
          ob_end_clean();
          header("location:OrderDetails.php?msg=success,$Oid");
      }
      else{
        header("location:OrderDetails.php?msg=failed,$Oid");
      }
  }
  else{
    header("location:OrderDetails.php?msg=failed2,$Oid");
  }

}
?>
<?php
if (isset ($_POST['View']) or "L"=="L"){
    $query= "select * from OrderDetails";
    if (isset ($_POST['View'])){
    $Views = unserialize($_POST['View']);
    $query= "select * from OrderDetails where $Views[2] == '$Views[1]'";
      }
    ?>
<!DOCTYPE html>
<html>
<head>
<style>
table th {
    width: auto !important;
}
#Search {
  background-position: 10px 10px;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 2px solid #ddd;
  margin-bottom: 12px;
}


</style>
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
          <a class="nav-link " href="inventory.php">Inventory</a>
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

<div class= "container ">
<br>
<div class= "table-responsive">
<input type="text" id="Search" onkeyup="Search()" placeholder="Search By Product Id..">
<table style = 'text-align:center' id = "myRecord" class="table table-bordered table-striped table-hover">
<thead>
<th> Order Id </th>
<th> Product Id </th>
<th> Product Name</th>
<th> Description </th>
<th> Quantity </th>
<th> Unit Price $</th>
<th>Extended Price $</th>
<th>  </th>
</thead>
<tbody>
<?php 

  $stm=$con->prepare($query);
  $stm->execute();
  $data=$stm->fetchAll(PDO::FETCH_ASSOC);
  foreach($data as $res){
    ?>
    <tr>
            <td><?php echo $res["Oid"];?></td>
            <td><?php echo $res["Pid"];?></td>
            <td><?php echo $res["Pname"];?></td>
            <td><?php echo $res["Description"];?></td>
            <td><?php echo $res["Quantity"];?></td>
            <td><?php echo $res["Price"];?></td>
            <td><?php echo bcmul($res["Price"],$res["Quantity"]);?></td>
        <td><br><form action= "OrderDetailsDu.php" method= "post" enctype="multipart/form-data">
        <button type="Delete" name ='Delete' value = <?php echo serialize(array("OrderDetails", $res['Oid'], $res['Pid']));?> class="btn btn-danger"> Delete</Button>
        <button type="Update" name = 'Update' value =<?php echo serialize(array("OrderDetails", $res['Oid'], $res['Pid']));?> class="btn btn-success">Update</Button></form></td>
    </tr>
    <?php
    
  };
if (isset($_GET["msg"]) && $_GET["msg"] == 'success') {
    echo "<b>Product Updated Successfully!!</b>";
  };
    
};?>
        </tbody>
        </table>
        </div>
    </div>
    <script>
function Search() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("Search");
  filter = input.value.toUpperCase();
  table = document.getElementById("myRecord");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>
</body>
</html>

