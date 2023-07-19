<?php 
$con = new PDO("sqlite:Vehicles.db");
$name =  $_POST['Username'];
$email = $_POST['Email'];
$mobile = $_POST['Phone'];
$password = $_POST['Password'];

$query = "SELECT * FROM users where email = '$email'";
$stm=$con->prepare($query);
$stm->execute();
$data=$stm->fetchAll(PDO::FETCH_ASSOC);
$check=count($data);
if($check >=1 )
{
header("location:signup.php?msg=failed");
}
else {
$query2 = "INSERT INTO users (name,Email,Phone,Password) values('$name','$email','$mobile','$password')";
$stm=$con->prepare($query2);
$stm->execute();
$query= "select id from users where email = '$email'";
$stm=$con->prepare($query);
$stm->execute();
$data=$stm->fetchAll(PDO::FETCH_ASSOC);
$id = strval($data[0]["id"]);
header("location:signup.php?msg2=$id");
};
?>