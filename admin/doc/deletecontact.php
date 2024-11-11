<?php
require_once './connec/myconnection.php';
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
$id=$_GET['id'];
$sql = "DELETE FROM contact WHERE contactID='$id'";
if ($conn->query($sql) === TRUE ) {
echo "<script>alert('Deleted!!!');</script>";
header("location:contactmanage.php");
} else {
echo "Error updating record: " . $conn->error;
}
$conn->close();
}
?>