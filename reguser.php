<?php
$con = new PDO("sqlite:Vehicles.db");

$email = $_POST['userid'];
$password = $_POST['Password'];
$query = "SELECT * FROM users where id = '$email' and Password = '$password'";
$stm=$con->prepare($query);
$stm->execute();
$data=$stm->fetchAll(PDO::FETCH_ASSOC);
$check=count($data);
if($check >= 1)
{
$query = "Insert into Login select id,name FROM users where id = '$email' and Password = '$password'";
$stm=$con->prepare($query);
$stm->execute();
header("location:index.php?msg2=success");
}
else {
header("location:signin.php?msg=failed");
}
?>