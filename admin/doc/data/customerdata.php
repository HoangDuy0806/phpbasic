<?php

class Customer { 
    public function showAllCustomer($conn) {
    $sql = "select username,name,email,address,phone from customer";
    $result = $conn->query($sql);
    return $result;
}
 
public function findCustomersbyID($conn, $id) {
//    $stmt = $conn->prepare("select ProductID,ProductName,ImageURL,UnitPrice from Products WHERE ProductID = ?");
//    $stmt->bind_param("i", intval($id));
//    $stmt->execute();
//    $result = $stmt->get_result();
      $sql="select name,email,address,phone from customer where username=$id";
      $result=$conn->query($sql);
    return $result;
 }
 
public function findCustomersRange($conn, $strIds) {
//    $stmt = $conn->prepare("SELECT ProductID,ProductName,ImageURL, UnitPrice FROM products WHERE ProductID IN ($strIds)");
//    $stmt->execute();
//    $result = $stmt->get_result();
    $sql="select name,email,address,phone from customer where username IN ($strIds)";
    $result=$conn->query($sql);
    return $result;
}
}?>
