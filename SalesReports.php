<?php 
$con = new PDO("sqlite:Vehicles.db"); 
if(isset ($_POST['submit'])){
    ob_start();
    $id = $_POST['id'];
    $qty = $_POST['Quantity'];
    $query= "select * from Inventory where id='$id'";
    $stm=$con->prepare($query);
    $stm->execute();
    $data=$stm->fetchAll(PDO::FETCH_ASSOC);
    $check=count($data);
    if($check >= 1){
        $query= "select * from Sales where id='$id'";
        $stm=$con->prepare($query);
        $stm->execute();
        $data2=$stm->fetchAll(PDO::FETCH_ASSOC);
        $check2=count($data2);
        $inv_qty=$data[0]['Quantity'];
        if($check2 == 0){
            if($inv_qty >= $qty){
                $id=$data[0]['id'];
                $name=$data[0]['name'];
                $des = $data[0]['Description'];
                $price =$data[0]['Unit_Price'];
                $query = "INSERT INTO Sales(id,Name,Quantity,Description,Unit_Price)
                values ($id,'$name','$qty','des',$price)";
                $stm=$con->prepare($query);
                $stm->execute();
                $sume=$inv_qty-$qty;
                $query = "Update inventory  SET  Quantity='$sume'
                where id = '$id'";
                $stm=$con->prepare($query);
                $stm->execute();
                ob_end_clean();
                header("location:uploadSales.php?msg=success");}
            else{
                header("location:uploadSales.php?msg2=failed");}
        }
        else{
            if(($data[0]['Quantity'])>=$qty){
                $inv_qty=$data[0]['Quantity'];
                $sume=$inv_qty-$qty;
                $query = "Update inventory SET Quantity='$sume'
                where id = '$id'";
                $stm=$con->prepare($query);
                $stm->execute();
                ob_end_clean();
                $query2="select * from sales where id='$id'";
                $stm=$con->prepare($query2);
                $stm->execute();
                $data_sales=$stm->fetchAll(PDO::FETCH_ASSOC);
                $sales_qty=$data_sales[0]['Quantity'];
                $qty2=$sales_qty+$qty;
                $query3 = "Update sales SET Quantity='$qty2'
                where id = '$id'";
                $stm=$con->prepare($query3);
                $stm->execute();
                header("location:uploadSales.php?msg4=success");}
            else{
                    header("location:uploadSales.php?msg5=failed");
                }
            }
    }
    else {
        header("location:uploadSales.php?msg3=failed");
                 }
}  

?>
<!DOCTYPE html>
<html>
<head>
<style>
  
.grid-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap = 500%;
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
          <a class="nav-link  active" href="SalesReports.php">Annual Sales</a>
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
<?php
$date = "SELECT strftime('%d-%m-%Y','now') as Date";
$stm=$con->prepare($date);
$stm->execute();
$data=$stm->fetchAll(PDO::FETCH_ASSOC);
$date = $data[0]['Date'];
$TAmount= "<a id='TAmount'></a>";
$MOrder= "<a id='MOrder'></a>";
$Mid= "<a id='Mid'></a>";
$query = "Select COUNT(*) as TOrders FROM Orders";
$stm=$con->prepare($query);
$stm->execute();
$data=$stm->fetchAll(PDO::FETCH_ASSOC);
$TOrders= $data[0]['TOrders'];
$query = "Select sum(Quantity) as TItems from OrderDetails od
INNER JOIN Orders o on o.id = od.Oid where strftime('%Y',date) = strftime('%Y','now')";
$stm=$con->prepare($query);
$stm->execute();
$data=$stm->fetchAll(PDO::FETCH_ASSOC);
$TItems= $data[0]['TItems'];
$query = "Select id as id,name as name from Login";
$stm=$con->prepare($query);
$stm->execute();
$data=$stm->fetchAll(PDO::FETCH_ASSOC);
$Name = $data[0]['name'];
$id = $data[0]['id'];
$pkr = "<a id='TAmountpkr'></a>";
?>
<div class="grid-container">

<div class="Employee Record" >
  <div class="Employee">
  <b><pre style = "font-size:105%; position: relative;">
Employee id  : <?php print_r($id);?>

SALES PERSON : <?php print_r($Name);?>  
REPORT DATE  : <?php print_r($date);?>       </pre> 
  </div>
</div>
<div class="Record" Details style="width: 58%; height: 50%; float:right;">
  <div class="Record"><b><pre style = "font-size:105%; position: relative;">  TOTAL ORDERS  : <?php echo $TOrders; ?>  
  <?php echo "Product Sold The Most : "; echo "
  Pid ";echo $Mid; echo"   $";echo "Amount : ";echo $MOrder;?>
  
  TOTAL ITEMS   : <?php echo $TItems; ?> 
  ANNUAL SALES  : $<?php echo $TAmount; ?> 
  ANNUAL SALES  : PKR <?php echo $pkr;?>
</pre> </b></div>
</div>
</b>
</div>

<table style = 'text-align:center ; border: 2px solid black;' id = "myRecord" class="table table-bordered table-striped table-hover">
<thead style = 'border: 2px solid black;'>
<th style = 'border: 2px solid black;'> PId </th>
<th style = 'border: 2px solid black;'> Product </th>
<th style = 'border: 2px solid black;'> Description </th>
<th style = 'border: 2px solid black;'> Quantity </th>
<th style = 'border: 2px solid black;'> Unit Price $</th>
<th  style = 'border: 2px solid black;'>Total Amount $</th>
</thead>
<tbody>
<?php 

  $query= "select DISTINCT(Pid) as Pid from OrderDetails od
   INNER JOIN Orders o on o.id = od.Oid where strftime('%Y',date) = strftime('%Y','now')";
  $stm=$con->prepare($query);
  $stm->execute();
  $data=$stm->fetchAll(PDO::FETCH_ASSOC);
  $TAmount = 0;
  $max=0;
  $mid =0;
  foreach($data as $id){
        $id = $id['Pid'];
        $query= "select sum(Quantity) as Quantity from OrderDetails INNER JOIN Orders on orders.id = OrderDetails.Oid where (OrderDetails.Pid = $id AND strftime('%Y',orders.date)=strftime('%Y','now'))";
        $stm=$con->prepare($query);
        $stm->execute();
        $data=$stm->fetchAll(PDO::FETCH_ASSOC);
        $Tqty = $data[0]['Quantity'];
        $query= "select * from Inventory where id=$id";
        $stm=$con->prepare($query);
        $stm->execute();
        $data=$stm->fetchAll(PDO::FETCH_ASSOC);
       
        foreach($data as $res){
          $amount = bcmul($res["Unit_Price"],$Tqty);
          if ($max <  $amount){
            $max=$amount;
            $mid = $res["id"];
          };
          $TAmount = $TAmount + bcmul($res["Unit_Price"],$Tqty);
          ?>
          <tr >
                  <td style = 'border: 2px solid black;'><?php echo $res["id"];?></td>
                  <td style = 'border: 2px solid black;'><?php echo $res["name"];?></td>
                  <td style = 'border: 2px solid black;'><?php echo $res["Description"];?></td>
                  <td style = 'border: 2px solid black;'><?php echo $Tqty ?></td>
                  <td style = 'border: 2px solid black;'><?php echo $res["Unit_Price"];?></td>
                  <td style = 'border: 2px solid black;'><?php echo bcmul($res["Unit_Price"],$Tqty);?></td>
          </tr>
          
          <?php
          
        }; 
      };
 ?>
 <b>
 <?php 
 
if (isset($_GET["msg"]) && $_GET["msg"] == 'success') {
  echo "<b>Product Updated Successfully!!</b>";
};

?> </b>
<?php

    
    
?>

        </tbody >
        </table>  
        
        </div>
    </div>

<script>
document.getElementById("TAmount").innerHTML = <?php print_r($TAmount);?>;
document.getElementById("TAmountpkr").innerHTML = <?php print_r(bcmul(228.73,$TAmount));?>;
document.getElementById("MOrder").innerHTML = <?php print_r($max);?>;
document.getElementById("Mid").innerHTML = <?php print_r($mid);?>;
</script>
</body>
</html>

