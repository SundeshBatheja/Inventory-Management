<?php 
$con = new PDO("sqlite:Vehicles.db"); 
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
<div class= "container ">
<br>
<div class= "table-responsive">
<input type="text" id="Search" onkeyup="Search()" placeholder="Search By Product Id..">
<table style = 'text-align:center' id = "myRecord" class="table table-bordered table-striped table-hover">
<thead>
<th> PId </th>
<th> Product </th>
<th> Description </th>
<th> Quantity </th>
<th> Unit Price $</th>
</thead>
<tbody>
<?php 

  $query= "select * from Inventory";
  $stm=$con->prepare($query);
  $stm->execute();
  $data=$stm->fetchAll(PDO::FETCH_ASSOC);
  foreach($data as $res){
    ?>
    <tr>
            <td><?php echo $res["id"];?></td>
            <td><?php echo $res["name"];?></td>
            <td><?php echo $res["Description"];?></td>
            <td><?php echo $res["Quantity"];?></td>
            <td><?php echo $res["Unit_Price"];?></td>
        <br><form action= "InventoryDu.php" method= "post" enctype="multipart/form-data">
    </tr>
    <?php
    
  };
 

    
?>
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
    td = tr[i].getElementsByTagName("td")[0];
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

