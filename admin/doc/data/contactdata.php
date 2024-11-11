<?php

class Contact { 
    public function showAllContact($conn) {
    $sql = "select * from contact ";
    $result = $conn->query($sql);
    return $result;
}
 
public function findContactsbyID($conn, $id) {
      $sql="select * from contact where username=$id";
      $result=$conn->query($sql);
    return $result;
 }
 
public function findContactsRange($conn, $strIds) {
//    $stmt = $conn->prepare("SELECT ProductID,ProductName,ImageURL, UnitPrice FROM products WHERE ProductID IN ($strIds)");
//    $stmt->execute();
//    $result = $stmt->get_result();
    $sql="select * from contact where username IN ($strIds)";
    $result=$conn->query($sql);
    return $result;
}
}?>
