<?php
session_start();

define("SERVER", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB", "foodshala");

$mysql = new mysqli(SERVER,USER,PASSWORD,DB);
if(isset($_POST['cregister'])){
    $fname = ($_POST['fname']);
    $address= ($_POST['address']);
    $contact= ($_POST['contact']);
    $email= ($_POST['email']);
    $pass= ($_POST['pass']);
    $choice= ($_POST['choice']);

    $sql = "INSERT INTO register_cus(name,address,contact,email,pass,choice) VALUES('$fname','$address','$contact','$email','$pass','$choice')";
    $mysql->query($sql);
    $_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
    header('location: cusIndex.php');

}
?>
<head>
  <title>Welcome to Foodshala</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<form action="cusRegister.php" method="post">
  <div class="container">
    <h1>Customer Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <label><b>Name:</b></label>
    <input type="text" placeholder="Your Full Name" name="fname" class="form-control" required style="border-radius: 4px">

    <label><b>Address:</b></label>
    <textarea placeholder="Full Address with City-Zip Code" name="address" class="form-control" required style="border-radius: 4px" rows="4"></textarea>

    <label><b>Contact:</b></label>
    <input type="text" placeholder="Your Mobile Number" name="contact" class="form-control" required style="border-radius: 4px">

    <label><b>Email:</b></label>
    <input type="email" placeholder="Your Email address" name="email" class="form-control" required style="border-radius: 4px">

    <label><b>Password: </b><span id="span1" style="color: red">Password is too short</span></label></label>
    <input type="password" placeholder="Create your Password" name="pass" id="pass1" class="form-control" required style="border-radius: 4px">

    <label><b>Re-enter Password: </b><span id="span2" style="color: red">Passwords do not match</span></label>
    <input type="password" placeholder="Re-enter your Password" name="pass1" id="pass2" class="form-control" required style="border-radius: 4px">

    <label><b>Veg/Non-Veg: </b></label>
      <select name="choice" required class="form-control" style="border-radius: 4px">
        <option selected disabled>Select your preference</option>
        <option id="v" value="Veg">Veg</option>
        <option id="n" value="N-Veg">Non-Veg</option>
      </select>

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a></p>
    <button type="submit" class="btn btn-warning" name="cregister" id="button">Register</button>
  </div>

  <div class="container">
    <p>Already have an account? <a href="cusLogin.php">Sign in</a>.</p>
  </div>
</form>

<script>
window.setInterval(function(){
    var pass1 = document.getElementById('pass1').value;
    var pass2 = document.getElementById('pass2').value;
    var alert1 = document.getElementById('span1');
    var alert2 = document.getElementById('span2');
    var button = document.getElementById('button');

    if (pass1.length < 6){
        alert1.style.display = "inline-block";
    }
    else{
        alert1.style.display = "none";
    }

    if (pass1!==pass2){
        alert2.style.display = "inline-block";
    }
    else{
        alert2.style.display = "none";
    }

    if (pass1 === pass2 && pass1.length>=6) {
        button.disabled = false;
    }
    else{
        button.disabled = true;
    }
  }, 200);
</script>