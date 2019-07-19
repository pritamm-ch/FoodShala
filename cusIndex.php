<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: cusLogin.php");
}

define("SERVER", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB", "foodshala");

$email = $_SESSION['email'];

$mysql = new mysqli(SERVER,USER,PASSWORD,DB);
$sql = "SELECT * FROM register_cus WHERE email='$email'";
$result = $mysql->query($sql);
    if(mysqli_num_rows($result) == 1){
        $row = $result->fetch_assoc();
        $name = $row['name'];     
}

?>
<head>
<title>
Welcome to Foodshala
</title>
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
<?php
if(isset($_SESSION['email']))
{
?>
<h1>Welcome <?php echo $name; ?> to FoodShala!</h1>
<?php
}
else{
    ?>
     <a href="cusIndex.php?logout='1'" style="color: blue;">login</a> 
    <?php
}
?>
<div id="result"></div>
<div style="text-align: right;"><a href="cusIndex.php?logout='1'" style="color: red;">logout</a> </div>
<hr>
<br>
<table>
<tr>
  <th>Restaurant</th>
  <th>Food Item</th> 
  <th>Description</th>
  <th>Price</th> 
  <th>Veg/NVeg</th>
  <th>Order</th>
 </tr>
 <?php
 $sql1 = "SELECT * FROM menu_list";
 $result1 = $mysql->query($sql1);
 if ($result1->num_rows > 0) {
  while($row1 = $result1->fetch_assoc()) {
   echo "<tr><td>" .$row1["name"]. "</td><td>" .$row1["food"]."</td><td>" .$row1["description"]. "</td><td>".$row1["price"]."/-". "</td><td>". $row1["choice"]. "</td><td>"."<button name=add".$row1["id"]." class=btn-warning id=".$row1["id"]." onclick=post(this.id) value=".$row1["id"].">Order</button>"."</td></tr>";

?>
<script>
function post(id){
    var userid = id;
    $.post('order.php',{ordid:userid},function(data){
     $('#result').html(data);
    });
}
</script>
<?php
}
echo "</table>";
} 
else { 
    echo "0 results"; 
}
?>
</div>
</body>