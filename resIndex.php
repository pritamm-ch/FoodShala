<?php
session_start();
if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: resLogin.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: resLogin.php");
}

define("SERVER", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB", "foodshala");

$email = $_SESSION['email'];
$mysql = new mysqli(SERVER,USER,PASSWORD,DB);

$sql = "SELECT * FROM register_res WHERE email='$email'";
    $result = $mysql->query($sql);
    if(mysqli_num_rows($result) == 1){
        $row = $result->fetch_assoc();
        $name = $row['name'];
}

if(isset($_POST['ritem'])){
$food = ($_POST['food']);
$description= ($_POST['description']);
$choice= ($_POST['choice']);
$price= ($_POST['price']);
        
$sql1 = "INSERT INTO menu_list(food,description,choice,email,price,name) VALUES('$food','$description','$choice','$email','$price','$name')";
$mysql->query($sql1);
}
?>
<head>
<title>Welcome to Foodshala</title>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
  table {
   border-collapse: collapse;
   width: 100%;
   color: #588c7e;
   font-family: monospace;
   font-size: 25px;
   text-align: center;
     } 
  th {
   background-color: #588c7e;
   color: white;
    }
  tr:nth-child(even) {background-color: #f2f2f2}
 </style>
</head>
<body>
  <div class="container">
<form action="resIndex.php" method="post">
  <div class="container">
    <h1>Welcome <?php echo $name; ?> to FoodShala!</h1>
    <p style="text-align: right;"> <a href="resIndex.php?logout='1'" style="color: red;">logout</a> </p>
    <p><b>Add Menu Item</b></p>
    <hr>
    
    <label><b>Food Item:</b></label>
    <input type="text" placeholder="Enter the name of food item" name="food" class="form-control" required style="border-radius: 4px">

    <label><b>Description: </b></label>
    <input type="text" placeholder="Describe your item in less than 50 words" name="description" class="form-control" required style="border-radius: 4px">

    <label><b>Veg/Non-Veg: </b></label>
      <select name="choice" required class="form-control" style="border-radius: 4px">
        <option selected disabled>Select Option</option>
        <option id="v" value="Veg">Veg</option>
        <option id="n" value="N-Veg">Non-Veg</option>
      </select>

      <label><b>Price: </b></label>
    <input type="text" placeholder="List your pricing" name="price" class="form-control" required style="border-radius: 4px">

   <br>
    <button type="submit" class="btn btn-warning" name="ritem" id="button">Add</button>
  </div>
</form>
<hr>
<h2>Your Menu:</h2><br>
<table>
<tr>
  <th>Food Item</th> 
  <th>Description</th>
  <th>Price</th> 
  <th>Veg/Non-Veg</th>
 </tr>
 <?php
 $sql2 = "SELECT * FROM menu_list WHERE email='$email'";
 $result1 = $mysql->query($sql2);
 if ($result1->num_rows > 0) {
  while($row1 = $result1->fetch_assoc()) {
   echo "<tr><td>" .$row1["food"]. "</td><td>" .$row1["description"]. "</td><td>".$row1["price"]."/-". "</td><td>". $row1["choice"]. "</td></tr>";
}
echo "</table>";
} 
else { 
    echo "0 results"; 
}
?>
<hr>
<h2>Your Orders:</h2>
<table>
<tr>
  <th>Food Item</th>  
  <th>Veg/Non-Veg</th>
  <th>Customer</th>
  <th>Address</th>
  <th>Contact</th>
 </tr>
 <?php
 $sql3 = "SELECT * FROM orders WHERE remail='$email'";
 $result2 = $mysql->query($sql3);
 if ($result2->num_rows > 0) {
  while($row2 = $result2->fetch_assoc()) {
   echo "<tr><td>" .$row2["food"]. "</td><td>" .$row2["choice"]. "</td><td>".$row2["cname"]."</td><td>". $row2["caddress"]."</td><td>". $row2["contact"]."</td></tr>";
}
echo "</table>";
} 
else { 
    echo "0 results"; 
}
?>
</div>
</body>
