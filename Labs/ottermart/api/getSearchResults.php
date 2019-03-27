<?php

    include '../dbConnection.php';
    $conn = getDatabaseConnection("ottermart");

    $namedParameters = array();
    $sql = "SELECT * FROM om_product WHERE 1";
    
    if(!empty($_GET['product'])) {
        $sql .= " AND productName LIKE :productName";
        $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters); // We NEED to include $namedParameters here
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($records);

?>