<?php
session_start();
require_once './admin/doc/connec/myconnection.php';
if(empty($_SESSION["username"])){
    header("location:login.php");
}else
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
$id=$_GET['id'];
$username=$_SESSION['username'];
$kt=true;
$sql1="select * from cart where username='$username' and pro_id='$id'";
$result=$conn->query($sql1);
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $amount=$row["amount"];
    $amount++;
    $sql="UPDATE `cart` SET `amount`='$amount' WHERE username='$username' and pro_id='$id'";
    $conn->query($sql);
    echo "<script>alert('Added!!!');</script>";
    $_REQUEST['id']=="";
    header("location:cart.php");
}else{
    $sql = "INSERT INTO `cart`(`username`, `pro_id`, `amount`) VALUES ('$username','$id','1')";
    if ($conn->query($sql) === TRUE ) {
    echo "<script>alert('Added!!!');</script>";
    $_REQUEST['id']=="";
    header("location:cart.php");
    } else {
    echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
}
?>