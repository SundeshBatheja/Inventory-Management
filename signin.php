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
  background-image: url("back.jpg");
  
  /* Add the blur effect */
  filter: blur(4px);
  -webkit-filter: blur(4px);
  
  /* Full height */
  height: 95%; 
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* Position text in the middle of the page/image */
.bg-text {
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0, 0.4); /* Black w/opacity/see-through */
  color: white;
  font-weight: bold;
  border: 2px solid #f1f1f1;
  position: absolute;
  top: 42%;
  left: 50%;
  transform: translate(-50%, -32%);
  z-index: 2;
  width: 50%;
  padding: 20px;
  text-align: left;
}
</style>
 </head>
    <body>    <!--Navbar Bootstrap-->
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand"aria-current="page">Dada  Bhai  Noorejee  Electronics</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      &nbsp;
      &nbsp;
      &nbsp;
      <?php
echo "<br>";
        if (isset($_GET["msg2"]) && $_GET["msg2"] == 'success') {
          echo '<script type ="text/JavaScript">';  
          echo 'alert("You have Successfully Logged In")';  
          echo '</script>';  

}
$con = new PDO("sqlite:Vehicles.db"); 
$query= "DELETE from Login";
$stm=$con->prepare($query);
$stm->execute();
?>
    </div>
  </div>
</nav>
<div class="bg-image"></div>

<div class=" bg-text">
    <div class = "w-50 m-auto">
    <br>
        <h1>SignIn</h1>
        Get Yourself Registered
        <p style="color:blue" > <a style="color:black" href="signup.php"> Sign Up </p></a>
        <form action="reguser.php" method = "post">
            <br>
            <div>
            <label for = user>Employee Id</label> 
            <input type="user" name="userid" autocomplete = "off" class = "form-control">
            </div>
            <br>
            <div>
            <label for = "pwd">Password</label> 
            <input type="password" name="Password" autocomplete = "off" class = "form-control">
            </div>
            
            <br><br>
            <button type="submit" submit class="btn btn-success">Submit</button>
        </form>
        <?php
        echo "<br>";
        if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
echo '<b><p>Wrong Employee Id / Password</p></b>';

} 
?>
    </div>
</div>
    </body>
</html>