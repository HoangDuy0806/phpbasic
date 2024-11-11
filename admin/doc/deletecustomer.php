<?php
require_once './connec/myconnection.php';
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
$id=$_GET['id'];
$sql1="DELETE FROM account WHERE username='$id'";
$sql = "DELETE FROM customer WHERE username='$id'";
if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
echo "<script>alert('Deleted!!!');</script>";
header("location:customermanage.php");
} else {
echo "Error updating record: " . $conn->error;
}
$conn->close();
}
?>