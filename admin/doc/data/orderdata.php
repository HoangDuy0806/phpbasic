<?php

class Order { 
    public function showAllOder($conn) {
    $sql = "select * from orderfreshshop";
    $result = $conn->query($sql);
    return $result;
}
 
public function findOrdersbyID($conn, $id) {
      $sql="select username,pro_id,amount,order_date,total_pay,address from orderfreshshop where order_id=$id";
      $result=$conn->query($sql);
    return $result;
 }
 
public function findOrdersRange($conn, $strIds) {
//    $stmt = $conn->prepare("SELECT ProductID,ProductName,ImageURL, UnitPrice FROM products WHERE ProductID IN ($strIds)");
//    $stmt->execute();
//    $result = $stmt->get_result();
    $sql="select username,pro_id,amount,order_date,total_pay,address from orderfreshshop where order_id IN ($strIds)";
    $result=$conn->query($sql);
    return $result;
}
}?>
