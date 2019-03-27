<?php
   include '../dbConnection.php';
   $conn = getDatabaseConnection("ottermart");
   
   $namedParameters = array();
   $sql = "SELECT * FROM om_product WHERE 1";
   
   if(!empty($_GET['product'])) {
       $sql .= " AND productName LIKE :productName";
       $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
   }
   if(!empty($_GET['category'])) {
       $sql .= " AND catId = :categoryId";
       $namedParameters[":categoryId"] = $_GET['category'];
   }
   if(!empty($_GET['priceFrom'])) {
       $sql .= " AND price >= :priceFrom";
       $namedParameters[":priceFrom"] = $_GET['priceFrom'];
   }
   if(!empty($_GET['priceTo'])) {
       $sql .= " AND price <= :priceTo";
       $namedParameters[":priceTo"] = $_GET['priceTo'];
   }
   $stmt = $conn->prepare($sql);
   $stmt->execute($namedParameters);
   $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
   echo json_encode($records);


?>