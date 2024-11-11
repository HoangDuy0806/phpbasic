<?php
require_once './admin/doc/connec/myconnection.php';
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
$id=$_GET['id'];
$sql = "DELETE FROM cart WHERE pro_id='$id'";
if ($conn->query($sql) === TRUE ) {
echo "<script>alert('Deleted!!!');</script>";
header("location:cart.php");
} else {
echo "Error updating record: " . $conn->error;
}
$conn->close();
}
?>