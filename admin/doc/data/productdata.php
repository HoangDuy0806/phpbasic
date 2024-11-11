<?php

class Product { 
    public function showAllProduct($conn) {
    $sql = "select * from product";
    $result = $conn->query($sql);
    return $result;
}
 
public function findProductsbyID($conn, $id) {
      $sql="select pro_name,amount,price,image from product where pro_id=$id";
      $result=$conn->query($sql);
    return $result;
 }
 
public function findProductsRange($conn, $strIds) {
//    $stmt = $conn->prepare("SELECT ProductID,ProductName,ImageURL, UnitPrice FROM products WHERE ProductID IN ($strIds)");
//    $stmt->execute();
//    $result = $stmt->get_result();
    $sql="select pro_name,amount,price,image from product where pro_id IN ($strIds)";
    $result=$conn->query($sql);
    return $result;
}
}?>
