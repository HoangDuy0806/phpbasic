<?php
session_start();
require_once './admin/doc/connec/myconnection.php';
if(empty($_SESSION["username"])){
    header("location:login.php");
}else
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
    $id=$_GET['id'];
    $username=$_SESSION['username'];
    $sql="select * from wishlist where username='$username'";
    $result=$conn->query($sql);
    $kt=true;
    while($row=$result->fetch_assoc()){
        if($id==$row["pro_id"]){
            echo "<script>alert('".$id."!!!');</script>";
            $kt=false;
            break;
        }
    }
    if($kt==true){
        $sql = "INSERT INTO `wishlist`(`username`, `pro_id`) VALUES ('$username','$id')";
        if ($conn->query($sql) === TRUE ) {
        echo "<script>alert('Added!!!');</script>";
        header("location:wishlist.php");
        } else {
        echo "Error updating record: " . $conn->error;
    }
    
        }
header("location:wishlist.php");

$conn->close();
}
?>