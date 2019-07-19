<?php
session_start();
$email = $_SESSION['email'];
define("SERVER", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB", "foodshala");
$mysql = new mysqli(SERVER,USER,PASSWORD,DB);
$userid = $_POST['ordid'];
$sql = "SELECT * FROM menu_list WHERE id='$userid'";
$sql2 = "SELECT * FROM register_cus WHERE email='$email'";
$result = $mysql->query($sql);
$result1 = $mysql->query($sql2);
if(mysqli_num_rows($result) == 1){
    $row = $result->fetch_assoc();
    $row1 = $result1->fetch_assoc();
    $food = $row['food'];
    $description = $row['description'];
    $choice = $row['choice'];
    $femail = $row['email'];
    $price = $row['price'];
    $fname = $row['name'];
    $cname = $row1['name'];
    $caddress = $row1['address'];
    $ccontact = $row1['contact'];
    $sql1 = "INSERT INTO orders(food,choice,cname,caddress,contact,cemail,remail) VALUES('$food','$choice','$cname','$caddress','$ccontact','$email','$femail')";
    $mysql->query($sql1);
    echo "<i style=color:#808080>";
    echo "Your ".$row['food']." is en-route";
    echo "</i>";
}
?>