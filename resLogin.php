<?php
session_start();

define("SERVER", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB", "foodshala");

$mysql = new mysqli(SERVER,USER,PASSWORD,DB);
if (isset($_POST['rlogin'])) {
$email = $_POST['email'];
$pass = $_POST['pass'];
$sql = "SELECT * FROM register_res WHERE email='$email' AND pass='$pass'";
$result = $mysql->query($sql);
if(mysqli_num_rows($result) == 1){
    $_SESSION['email'] = $email;
    $_SESSION['success'] = "You are now logged in";
    header('location: resIndex.php');
}
else{
    ?>
    <script>
    $(document).change(function(){
               $("#wrong").show();
 });
    </script>
    <?php
}
}
?>
<head>
  <title>Welcome to Foodshala</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<form action="resLogin.php" method="post">
  <div class="container">
    <h1>Restaurant Login</h1>
    <p id="wrong" style="display:none;">Wrong email/password combination.</p>
    <hr>
    
    <label><b>Email:</b></label>
    <input type="email" placeholder="Organization Official Email address" name="email" class="form-control" required style="border-radius: 4px">

    <label><b>Password: </b></label>
    <input type="password" placeholder="Enter your Password" name="pass" class="form-control" required style="border-radius: 4px">
   <br>
    <button type="submit" class="btn btn-warning" name="rlogin" id="button">Login</button>
  </div>

  <div class="container">
  <p><div style="text-align: left">Not yet a member? <a href="resRegister.php">Sign up</a></div><div style="text-align: right">Are you a customer? <a href="cusLogin.php">Sign in</a></div></p>
  </div>
</form>

