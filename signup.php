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
  height: 92%; 
  
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
  top: 40%;
  left: 50%;
  transform: translate(-50%, -33%);
  z-index: 2;
  width: 50%;
  padding: 10px;
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
  </div>
</nav>
    <div class="bg-image"></div>

<div class=" bg-text">


    <div class = "w-50 m-auto">
        <h1>Signup</h1>Already have an account? <p style="color:blue"> <a style="color:black" href="signin.php"> Sign in </p></a>
        <form action="userinfo.php" method = "post">
            <div>
            <label>Employee Name</label> 
            <input type="text" name="Username" autocomplete = "off" class = "form-control">
            </div>
            <br>
            <div>
            <label for = "phone">Phone</label> 
            <input type="tel" name="Phone" autocomplete = "off" class = "form-control">
            </div>
            <br>
            <div>
            <label for = "email">Email</label> 
            <input type="email" name="Email" autocomplete = "on" class = "form-control">
            </div>
            <br>
            <div>
            <label for = "pwd">Password</label> 
            <input type="password" name="Password" autocomplete = "off" class = "form-control">
            </div>
            
            <br>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
        <?php
echo "<br>";
if (isset($_GET["msg2"])) {
  echo "<b>Your Employee Id is : </b>";
  echo $_GET["msg2"];
}  
?>
        <?php
        echo "<br>";
        if (isset($_GET["msg"]) && $_GET["msg"] == 'failed') {
echo '<b><p style= "color:white">Email Already Exists!</p></b>';

} 
?>
    </div>
    </div>
    </body>
</html>